<?php

/**
 * Post form.
 *
 * @package    training
 * @subpackage form
 * @author     Muhammadali Shaduli
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class PostForm extends BasePostForm
{
  public function configure()
  {
      unset($this['created_at'], $this['updated_at']);
  }
}
