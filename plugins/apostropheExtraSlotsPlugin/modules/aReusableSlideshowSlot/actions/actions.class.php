<?php
class aReusableSlideshowSlotActions extends BaseaSlideshowSlotActions
{
  // After media ids are set (even if to an empty slideshow) we don't want
  // to reuse some other slideshow anymore
  protected function afterSetMediaIds()
  {
    $value = $this->slot->getArrayValue();
    unset($value['reuse']);
    $this->slot->setArrayValue($value);
  }

  /**
   * DOCUMENT ME
   * @param sfRequest $request
   * @return mixed
   */
  public function executeEdit(sfRequest $request)
  {
    $result = parent::executeEdit($request);
    if (!is_null($result))
    {
      return $result;
    }
    
    $aReusableSlot = Doctrine::getTable('aReusableSlot')->findOneBySlot($this->pageid, $this->name, $this->permid);
    
    // Work around FCK's incompatibility with AJAX and bracketed field names
    // (it insists on making the ID bracketed too which won't work for AJAX)
    
    // Don't forget, there's a CSRF field out there too. We need to grep through
    // the submitted fields and get all of the relevant ones, reinventing what
    // PHP's bracket syntax would do for us if FCK were compatible with it
    
    $values = $request->getParameterHolder()->getAll();
    $value = array();
    foreach ($values as $k => $v)
    {
      if (preg_match('/^slot-form-' . $this->id . '-(.*)$/', $k, $matches))
      {
        $value[$matches[1]] = $v;
      }
    }
    
    if ($value)
    {
      $this->form = new aReusableSlideshowSlotEditForm($this->id, $aReusableSlot, $this->slot);
      $this->form->bind($value);
      if ($this->form->isValid())
      {
        if ($this->form->getValue('label_or_reuse') === 'label')
        {
          if (!$aReusableSlot)
          {
            $aReusableSlot = new aReusableSlot();
            $aReusableSlot->page_id = $this->pageid;
            $aReusableSlot->area_name = $this->name;
            $aReusableSlot->permid = $this->permid;
            $aReusableSlot->type = $this->slot->type;
          }
          $aReusableSlot->label = $this->form->getValue('label');
          $aReusableSlot->blurb = $this->form->getValue('blurb');
          $aReusableSlot->save();
          
          // Store the name redundantly in the slot itself since we've been asked
          // to present it to the user in some situations and we should do that
          // efficiently
          $values = $this->slot->getArrayValue();
          // Implies we're not reusing something else anymore
          unset($values['reuse']);
          $values['label'] = $this->form->getValue('label');
          $values['blurb'] = $this->form->getValue('blurb');
          $this->slot->setArrayValue($values);
          return $this->editSave();
        }
        else
        {
          $aReusableSlot = Doctrine::getTable('aReusableSlot')->find($this->form->getValue('reuse'));
          $this->slot->setArrayValue(array('reuse' => array('id' => $aReusableSlot->id, 'page_id' => $aReusableSlot->page_id, 'area_name' => $aReusableSlot->area_name, 'permid' => $aReusableSlot->permid)));
          return $this->editSave();
        }
      }
    }
    return $this->editRetry();
  }
}
  