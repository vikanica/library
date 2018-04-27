<?php
require 'vendor/autoload.php';
    $db = new \atk4\data\Persistence_SQL('mysql:host=127.0.0.1;dbname=library;charset=utf8', 'root', '');
class Librarian extends \atk4\data\Model {
	public $table = 'librarians';
function init() {
	parent::init();
	$this->addField('name');
  $this->addField('surname');
  $this->addField('password',['type'=>'password']);
}
}
class Student extends \atk4\data\Model {
	public $table = 'students';
function init() {
	parent::init();
  $this->addField('name');
  $this->addField('surname');
  $this->addField('password',['type'=>'password']);
  $this->hasMany('Borrow', new Borrow);
}
}
class Book extends \atk4\data\Model {
	public $table = 'books';
function init() {
	parent::init();
  $this->addField('name');
  $this->addField('author');
  $this->addField('year_published',['type'=>'date']);
  $this->addField('total_quantity');
  $this->hasMany('Borrow', new Borrow);
}
}
class Borrow extends \atk4\data\Model {
	public $table = 'borrow';
function init() {
	parent::init();
  $this->addField('date_loan',['type'=>'date']);
  $this->addField('date_returned',['type'=>'date']);
  $this->addField('quantity');
  $this->addField('returned',['type'=>'boolean']);
 $this->hasOne('student_id', new Student)->addTitle();
 $this->hasOne('book_id', new Book)->addTitle();
}
}
















  //$this->hasMany('Record', new Record);
