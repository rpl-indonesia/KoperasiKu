<?php
/**
 *
 * Controller KoperasiKu
 *
 */
namespace lib\controller;

class controller {
  private $hostname = '127.0.0.1';
  private $username = 'root';
  private $password = '';
  private $database = 'db_koperasi';

  public function __construct(){
    // error_reporting(0);
    $cn = $this->Connection();
    if (!$cn) {
      die("<span style='font-family: sans-serif;'>Couldn't Connect to SQL Server!</span>");
    }
  }

  public function Connection(){
    $cn = mysqli_connect($this->hostname, $this->username, $this->password, $this->database);
    return $cn;
  }

  public function query($text){
    $cn = $this->Connection();
    $sql = mysqli_query($cn, $text);
    return $sql;
  }

  public function Insert($table, array $field){
    $sql = "INSERT INTO ".$table." set ";
    foreach ($field as $key => $value) {
      $sql .= $key."='".$value."',";
    }
    $sql = rtrim($sql, ',');
    $jalan = $this->query($sql);
    return $jalan;
  }

  public function update($table, array $field, array $where){
    $sql = "UPDATE ".$table." set ";
    foreach ($field as $key => $value) {
      $sql .= $key."='".$value."',";
    }
    $sql = rtrim($sql, ',');
    $sql .= " where ".$where['where']."='".$where['id']."'";
    $jalan = $this->query($sql);
    return $jalan;
  }

  public function hapus($table, array $where){
    $sql = "DELETE FROM ".$table." WHERE ".$where['where']."='".$where['id']."'";
    $jalan = $this->query($sql);
    return $jalan;
  }

  public function ambilSatu($table){
    $sql = "SELECT * FROM ".$table;
    $jalan = $this->query($sql);
    return mysqli_fetch_object($jalan);
  }

  public function ambil($table, array $where){
    $sql = "SELECT * FROM ".$table." WHERE ".$where['where']."='".$where['id']."'";
    $jalan = $this->query($sql);
    return mysqli_fetch_object($jalan);
  }

  public function showData($table){
    $sql = "SELECT * FROM ".$table;
    $jalan = $this->query($sql);
    $data = array();
    while ($r = mysqli_fetch_object($jalan)) {
      $data[] = $r;
    }
    return $data;
  }

  public function showDataSearch($table, array $field, $tcari, $sqlAkhir = ''){
    $sql = "SELECT * FROM ".$table." where ";
    foreach ($field as $r) {
      $sql .= $r." like '%".$tcari."%' or ";
    }
    $sql = rtrim($sql, 'or ');
    $sql .= ' '.$sqlAkhir;
    $jalan = $this->query($sql);
    $data = array();
    while ($r = mysqli_fetch_object($jalan)) {
      $data[] = $r;
    }
    return $data;
  }

  public function validationCheckData($table){
    $sql = "SELECT * FROM ".$table;
    $jalan = $this->query($sql);
    return mysqli_num_rows($jalan);
  }

  public function validationCheckDataSearch($table, array $field, $tcari, $sqlAkhir = ''){
    $sql = "SELECT * FROM ".$table.' where ';
    foreach ($field as $r) {
      $sql .= $r." like '%".$tcari."%' or ";
    }
    $sql = rtrim($sql, 'or ');
    $sql .= ' '.$sqlAkhir;
    $jalan = $this->query($sql);
    return mysqli_num_rows($jalan);
  }

  public function login($table, array $field, array $ses){
    $sql = "SELECT * FROM ".$table." WHERE ";
    foreach ($field as $key => $value) {
      $sql .= $key."='".$value."' AND ";
    }
    $sql = rtrim($sql, 'AND ');
    $jalan = $this->query($sql);
    $cek = mysqli_num_rows($jalan);
    if ($cek > 0) {
      $_SESSION[sha1($ses['ses'])] = $ses['primary'];
      return true;
    }else{
      return false;
    }
  }

  public function getSessionLogin($table, array $ses){
    $sql = "SELECT * FROM ".$table." where ".$ses['primary']."='".$_SESSION[sha1($ses['ses'])]."'";
    $jalan = $this->query($sql);
    if (mysqli_num_rows($jalan) == 0) {
      $this->logout($ses['ses']);
    }
    return mysqli_fetch_object($jalan);
    return $sql;
  }

  public function logout($ses, $redirect = '../login/'){
    unset($_SESSION[sha1($ses)]);
    echo "<script>document.location.href='".$redirect."'</script>";
  }

  public function setSes($ses, $value){
    $_SESSION[sha1($ses)] = $value;
  }

  public function getSes($ses){
    if (isset($_SESSION[sha1($ses)])) {
      $output = $_SESSION[sha1($ses)];
    }else{
      $output = '';
    }
    return $output;
  }

  public function unsetSes($ses){
    unset($_SESSION[sha1($ses)]);
  }

  public function setSes2($ses, $value, $batas = 1){
    $a = array($value, time() + $batas);
    $_SESSION[sha1($ses)] = $a;
  }

  public function getSes2($ses){
    if (isset($_SESSION[sha1($ses)])) {
      $output = $_SESSION[sha1($ses)][0];
    }else{
      $output = '';
    }
    return $output;
  }

  public function unsetSes2($ses){
    if (isset($_SESSION[sha1($ses)])) {
      if (time() > $_SESSION[sha1($ses)][1]) {
        unset($_SESSION[sha1($ses)]);
      }
    }
  }

  public function CountData($table){
    $sql = "SELECT * FROM ".$table;
    $jalan = $this->query($sql);
    $data = array();
    while ($r = mysqli_fetch_object($jalan)) {
      $data[] = $r;
    }
    $count = count($data);
    return $count;
  }

}
