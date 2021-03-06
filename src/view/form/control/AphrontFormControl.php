<?php

/*
 * Copyright 2011 Facebook, Inc.
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *   http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */

abstract class AphrontFormControl extends AphrontView {

  private $label;
  private $caption;
  private $error;
  private $name;
  private $value;
  private $disabled;
  private $id;
  private $controlID;
  private $controlStyle;

  public function setID($id) {
    $this->id = $id;
    return $this;
  }

  public function getID() {
    return $this->id;
  }

  public function setControlID($control_id) {
    $this->controlID = $control_id;
    return $this;
  }

  public function getControlID() {
    return $this->controlID;
  }

  public function setControlStyle($control_style) {
    $this->controlStyle = $control_style;
    return $this;
  }

  public function getControlStyle() {
    return $this->controlStyle;
  }

  public function setLabel($label) {
    $this->label = $label;
    return $this;
  }

  public function getLabel() {
    return $this->label;
  }

  public function setCaption($caption) {
    $this->caption = $caption;
    return $this;
  }

  public function getCaption() {
    return $this->caption;
  }

  public function setError($error) {
    $this->error = $error;
    return $this;
  }

  public function getError() {
    return $this->error;
  }

  public function setName($name) {
    $this->name = $name;
    return $this;
  }

  public function getName() {
    return $this->name;
  }

  public function setValue($value) {
    $this->value = $value;
    return $this;
  }

  public function getValue() {
    return $this->value;
  }

  public function setDisabled($disabled) {
    $this->disabled = $disabled;
    return $this;
  }

  public function getDisabled() {
    return $this->disabled;
  }

  abstract protected function renderInput();
  abstract protected function getCustomControlClass();

  protected function shouldRender() {
    return true;
  }

  final public function render() {
    if (!$this->shouldRender()) {
      return null;
    }

    $custom_class = $this->getCustomControlClass();

    if (strlen($this->getLabel())) {
      $label =
        '<label class="aphront-form-label">'.
          phutil_escape_html($this->getLabel()).
          ':'.
        '</label>';
    } else {
      $label = null;
      $custom_class .= ' aphront-form-control-nolabel';
    }

    $input =
      '<div class="aphront-form-input">'.
        $this->renderInput().
      '</div>';

    if (strlen($this->getError())) {
      $error = $this->getError();
      if ($error === true) {
        $error = '*';
      } else {
        $error = "\xC2\xAB ".$error;
      }
      $error =
        '<div class="aphront-form-error">'.
          phutil_escape_html($error).
        '</div>';
    } else {
      $error = null;
    }

    if (strlen($this->getCaption())) {
      $caption =
        '<div class="aphront-form-caption">'.
          $this->getCaption().
        '</div>';
    } else {
      $caption = null;
    }

    return phutil_render_tag(
      'div',
      array(
        'class' => "aphront-form-control {$custom_class}",
        'id' => $this->controlID,
        'style' => $this->controlStyle,
      ),
      $error.
      $label.
      $input.
      $caption.
      '<div style="clear: both;"></div>');
  }
}
