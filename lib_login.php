<?php
require 'connection.php';
$app = new \atk4\ui\App('LIBRARY');
$app->initLayout('Centered');
$someone = new Librarian($db);
$form = $app->layout->add('Form');
$form->setModel(new Librarian($db));
$form->buttonSave->set('Вход');
$form->onSubmit(function($form) use ($someone) {
  //$form->model['nick_name']
  //$someone = $form->model->tryLoadBy('nick_name','fiqegqdj0[wqdw]');
  $someone->tryLoadBy('name',$form->model['name']);
  if ($someone['surname'] == $form->model['surname']){
    if ($someone['password'] == $form->model['password']) {
      $_SESSION['user_id'] = $someone->id;
      $_SESSION['status'] = 'librarian';
      return new \atk4\ui\jsExpression('document.location="main.php"');
    } else {
      $someone->unload();
      $er = (new \atk4\ui\jsNotify('No such user.'));
      $er->setColor('black');
      return $er;
    }
  } else {
    $someone->unload();
    $er = (new \atk4\ui\jsNotify('No such user.'));
    $er->setColor('red');
    return $er;
  }
});
