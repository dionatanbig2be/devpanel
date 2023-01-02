
<?php
class Bootstrap_Field
{
    private $fieldType;
    private $id;
    private $disabled;
    private $prepend;
    private $append;
    private $value;
    private $placeHolder;
    private $buttonTitle;
    private $buttonClasses;
    private $buttonTitleRight;
    private $fileLabel;
    private $checkboxLabel;
    private $checkboxChecked;
    private $comboValues;
    private $comboTitles;
    private $comboSelectedValue;
    private $comboMultiSelect;
    private $extraClassField;
    private $extraClassGroup;
    private $textAreaCols;
    private $textAreaRows;
    private $dropdownItems;
    private $fileMultiple;
    private $readonly;

    const TYPE_INPUT_NUMBER = "number";
    const TYPE_INPUT_TEXT = "text";
    const TYPE_TEXT_AREA = "textarea";
    const TYPE_TEXT_SMILE = "textarea";
    const TYPE_INPUT_PASSWORD = "password";
    const TYPE_INPUT_DATE = "date";
    const TYPE_INPUT_TIME = "time";
    const TYPE_INPUT_DATETIME = "datetime-local";
    const TYPE_INPUT_HIDDEN = "hidden";
    const TYPE_HIDDEN = "hidden";
    const TYPE_INPUT_FILE = "file";
    const TYPE_INPUT_CHECKBOX = "checkbox";
    const TYPE_INPUT_COMBO = "combo";
    const TYPE_BUTTON_NORMAL = "button";
    const TYPE_BUTTON_SUBMIT = "submit";
    const TYPE_BUTTON_DROPDOWN = "dropdown";

    function initialize($fieldType, $id, $disabled = false)
    {
        $this->fieldType = $fieldType;
        $this->id = $id;
        $this->disabled = $disabled;
        $this->prepend = "";
        $this->append = "";
        $this->placeHolder = "";
        $this->buttonTitle = "";
        $this->buttonClasses = "";
        $this->buttonTitleRight = false;
        $this->fileLabel = "";
        $this->checkboxLabel = "";
        $this->checkboxChecked = false;
        $this->comboMultiSelect = "";
        $this->comboValues = [];
        $this->comboTitles = [];
        $this->comboSelectedValue = "";
        $this->extraClassField = "";
        $this->extraClassGroup = "";
        $this->value = "";
        $this->textAreaCols = 0;
        $this->textAreaRows = 0;
        $this->dropdownItems = [];
        $this->fileMultiple = false;
        $this->readonly = false;
        $this->setFirstRow = false;
        return $this;
    }

    function setReadOnly()
    {
        $this->readonly = true;
        return $this;
    }

    function setPrepend($prepend)
    {
        $this->prepend = $prepend;
        return $this;
    }

    function setValue($value)
    {
        $this->value = $value;
        return $this;
    }

    function setTextArea($cols, $rows)
    {
        $this->textAreaCols = $cols;
        $this->textAreaRows = $rows;
        return $this;
    }

    function setPlaceHolder($placeHolder)
    {
        $this->placeHolder = $placeHolder;
        return $this;
    }

    function setAppend($append)
    {
        $this->append = $append;
        return $this;
    }

    function setFileLabel($label)
    {
        $this->fileLabel = $label;
        return $this;
    }

    function setFileMultiple($multiple = true)
    {
        $this->fileMultiple = $multiple;
        return $this;
    }

    function setCheckbox($checkboxLabel, $checkboxChecked = false)
    {
        $this->checkboxLabel = $checkboxLabel;
        $this->checkboxChecked = $checkboxChecked;
        return $this;
    }

    function addDropdownItem($id, $title)
    {
        $this->dropdownItems[] = ["id" => $id, "title" => $title];
        return $this;
    }

    function setButtonTitle($buttonTitle, $toRight = false)
    {
        $this->buttonTitle = $buttonTitle;
        $this->buttonTitleRight = $toRight;
        return $this;
    }

    function setButtonClasses($buttonClasses)
    {
        $this->buttonClasses = $buttonClasses;
        return $this;
    }

    function setCombo($comboValues, $comboTitles, $comboSelectedValue = "", $multiselect = false)
    {
        $this->comboValues = $comboValues;
        $this->comboTitles = $comboTitles;
        $this->comboSelectedValue = $comboSelectedValue;
        $this->comboMultiSelect = ($multiselect ? "multiple" : "");
        return $this;
    }

    function setComboFirstRow($title, $value = '')
    {
        $this->comboFirstValue = $value;
        $this->comboFirstTitle = $title;
        $this->setFirstRow = true;
        return $this;
    }

    function addClassField($classes)
    {
        $this->extraClassField .= $classes;
        return $this;
    }

    function addClassGroup($classes)
    {
        $this->extraClassGroup .= $classes;
        return $this;
    }

    function output()
    {
        echo $this->toString();
    }

    function toString()
    {
        $ans = "";
        switch ($this->fieldType) {
            case Bootstrap_Field::TYPE_INPUT_NUMBER:
            case Bootstrap_Field::TYPE_INPUT_TEXT:
            case Bootstrap_Field::TYPE_INPUT_DATE:
            case Bootstrap_Field::TYPE_INPUT_TIME:
            case Bootstrap_Field::TYPE_INPUT_DATETIME:
            case Bootstrap_Field::TYPE_INPUT_PASSWORD:
                $readonlystr = ($this->readonly) ? " readonly" : "";
                $ans .= "<div class='input-group {$this->extraClassGroup}'>";
                if (strlen($this->prepend) > 0) $ans .= "<div class='input-group-prepend'><div class='input-group-text'>{$this->prepend}</div></div>";
                $ans .= "<input type='{$this->fieldType}' class='form-control {$this->extraClassField}' 
								name='{$this->id}' id='{$this->id}' value='{$this->value}' autocomplete='off'";
                if ($this->disabled) $ans .= " disabled";
                if (strlen($this->placeHolder) > 0) $ans .= " placeholder='{$this->placeHolder}'";
                $ans .= "$readonlystr>";
                if (strlen($this->append) > 0) $ans .= "<div class='input-group-append'><div class='input-group-text'>{$this->append}</div></div>";
                $ans .= "</div>";
                break;

            case Bootstrap_Field::TYPE_INPUT_HIDDEN:
                $ans .= "<input type='{$this->fieldType}' class='form-control' name='{$this->id}' id='{$this->id}' value='{$this->value}'>";
                break;

            case Bootstrap_Field::TYPE_BUTTON_NORMAL:
            case Bootstrap_Field::TYPE_BUTTON_SUBMIT:
                $ans .= "<button type='" . (($this->fieldType == Bootstrap_Field::TYPE_BUTTON_NORMAL) ? "button" : "submit") . "'";
                $ans .= "class='btn {$this->buttonClasses} {$this->extraClassField}' name='{$this->id}' id='{$this->id}'>{$this->buttonTitle}</button>";
                if ($this->buttonTitleRight) $ans = '<div class="text-right">' . $ans . '</div>';
                break;

            case Bootstrap_Field::TYPE_INPUT_FILE:
                $ans .= "<div class='input-group'><input type='file' name='{$this->id}[]' class='custom-file-input' id='{$this->id}' lang='pt'";
                if ($this->disabled) $ans .= ' disabled';
                if ($this->fileMultiple) $ans .= " multiple";
                $ans .= ">";
                if (strlen($this->fileLabel) > 0) $ans .= "<label class='custom-file-label' id='label_{$this->id}' for='{$this->id}'>{$this->fileLabel}</label>";


                if (strlen($this->append) > 0) $ans .= "<small id='" . $this->id . "Help' class='form-text text-muted'>{$this->append}</small>";

                $ans .= "</div>";
                break;

                /* case Bootstrap_Field::TYPE_INPUT_FILE:
				$ans .= "<div class='input-group'><div class='custom-file {$this->extraClassField}'><input type='file' name='{$this->id}[]' class='custom-file-input' id='{$this->id}' lang='pt'";
				if ($this->disabled) $ans .= ' disabled';
				if ($this->fileMultiple) $ans .= " multiple";
				$ans .= ">";
				if (strlen($this->fileLabel) > 0) $ans .= "<label class='custom-file-label' id='label_{$this->id}' for='{$this->id}'>{$this->fileLabel}</label>";

				
				if (strlen($this->append) > 0) $ans .= "<small id='emailHelp' class='form-text text-muted'>{$this->append}</small>";
				$ans .= "</div>";
				$ans .= "</div>";
				break; */

            case Bootstrap_Field::TYPE_INPUT_CHECKBOX:
                $ans .= "<div class='custom-control custom-checkbox {$this->extraClassGroup}'>
								 <input type='checkbox' class='custom-control-input {$this->extraClassField}' name='{$this->id}' id='{$this->id}'";
                if ($this->checkboxChecked) $ans .= ' checked';
                if ($this->disabled) $ans .= ' disabled';
                $ans .= ">";
                $ans .= "<label class='custom-control-label' for='{$this->id}'>{$this->checkboxLabel}</label></div>";
                break;

            case Bootstrap_Field::TYPE_INPUT_COMBO:
                $ans .= "<div class='input-group {$this->extraClassGroup}'>";
                if (strlen($this->prepend) > 0) $ans .= "<div class='input-group-prepend'><div class='input-group-text'>{$this->prepend}</div></div>";
                $ans .= "<select class='custom-select {$this->extraClassField}' name='{$this->id}' id='{$this->id}' {$this->comboMultiSelect}";
                if ($this->disabled) $ans .= ' disabled';
                $ans .= ">";
                if ($this->setFirstRow) {
                    $ans .= "<option value='" . $this->comboFirstValue . "'>" . $this->comboFirstTitle . "</option>";
                }
                for ($k = 0; $k < count($this->comboValues); $k++) {
                    $ans .= "<option value='" . $this->comboValues[$k] . "'";
                    if ($this->comboValues[$k] == $this->comboSelectedValue) $ans .= " selected";
                    $ans .= ">" . $this->comboTitles[$k] . "</option>";
                }
                $ans .= "</select></div>";
                break;

            case Bootstrap_Field::TYPE_TEXT_AREA:
                $ans .= "<textarea rows={$this->textAreaRows} cols={$this->textAreaCols} id={$this->id} name={$this->id} class='{$this->extraClassGroup}'>";
                $ans .= $this->value . "</textarea>";
                break;

            case Bootstrap_Field::TYPE_BUTTON_DROPDOWN:
                $ans .= "<div class='dropdown show'><a class='btn {$this->buttonClasses} {$this->extraClassField} dropdown-toggle'
                                                    href='#' role='button' id='{$this->id}' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                                                    {$this->buttonTitle}</a>
                                                    <div class='dropdown-menu' aria-labelledby='dropdownMenuLink'>";
                foreach ($this->dropdownItems as $item) $ans .= "<a class='dropdown-item' href='#' id='{$item["id"]}'>{$item["title"]}</a>";
                $ans .= "</div></div>";
                break;
        }
        return $ans;
    }
}
