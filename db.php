<?php
date_default_timezone_set('Europe/Stockholm');

function getConn() {
  try {
    $db = new PDO(
      'mysql:host=placeholder-hostname;dbname=placeholder-dbname',
      'placeholder-dbuser',
      'placeholder-dbpass'
    );
  } catch (PDOException $e) {
    print "Error!: " . $e->getMessage() . "<br/>";
    die();
  }
  $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  return $db;
}

function setup() {
  $db = getConn();
  $query = "CREATE TABLE IF NOT EXISTS scrapes(
              year INT,
              week INT,
              restaurant VARCHAR(100),
              updated_at TIMESTAMP,
              html VARCHAR(9999),
              CONSTRAINT `pk` PRIMARY KEY (year, week, restaurant)
            ) CHARSET=utf8";
  $res = $db->query($query);
}

setup();

function saveScrape($restaurant, $html) {
  $db = getConn();
  $stmt = $db->prepare("INSERT INTO scrapes (year, week, restaurant, updated_at, html)
            VALUES(:y, :w, :r, null, :h)
            ON DUPLICATE KEY UPDATE
            updated_at=VALUES(updated_at),
            html=VALUES(html)");
  $stmt->execute(array(
    ':y' => date('Y'),
    ':w' => date('W'),
    ':r' => $restaurant,
    ':h' => $html
  ));
}

function getScrape($restaurant, $week = false, $year = false) {
  $db = getConn();
  $week = $week ? $week : date('W');
  $year = $year ? $year : date('Y');
  $q = "SELECT * FROM scrapes WHERE restaurant=:r AND week=:w AND year=:y LIMIT 1";
  $stmt = $db->prepare($q);
  $stmt->execute(array(
    ':y' => $year,
    ':w' => $week,
    ':r' => $restaurant
  ));
  return $stmt->fetch(PDO::FETCH_ASSOC);
}
