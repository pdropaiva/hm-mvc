<?php
/**
 *
 */
class Controller
{

  protected $request;
  protected $method;
  private $errors;
  private $successes;

  protected $title;
  protected $url;

  function __construct($title = '')
  {
    $this->request = $_REQUEST;
    $this->method = $_SERVER['REQUEST_METHOD'];
    $this->title = $title;
    $this->url = $_SERVER['REQUEST_SCHEME'].'://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
    $this->errors = array();
    $this->successes = array();
  }

  public function getTitle() {
      return $this->title;
  }

  public function getMethod() {
      return $this->method;
  }

  public function getRequest($key) {

      if(!isset($this->request[$key])) return null;
      return $this->request[$key];
  }

  public function setError($key, $value) {

      $this->errors[$key] = $value;
      setSession('errors', $this->errors);
  }

  public function getError($key) {

      $this->errors = $this->getErrors();

      if(!isset($this->errors[$key])) return null;

      return $this->errors[$key];
  }

  public function getErrors() {

      $errors = getSession('errors');

      if($errors) {
          $this->errors = $errors;
          forgetSession('errors');
      }

      return $this->errors;
  }

  public function setSuccesses($key, $value) {

      $this->successes[$key] = $value;
      setSession('successes', $this->successes);
  }

  public function getSuccess($key) {

      $this->successes = $this->getErrors();

      if(!isset($this->successes[$key])) return null;

      return $this->successes[$key];
  }

  public function geSuccesses() {

      $successes = getSession('successes');

      if($successes) {
          $this->successes = $successes;
          forgetSession('successes');
      }

      return $this->successes;
  }
}
