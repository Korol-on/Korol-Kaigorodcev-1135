<?php

namespace App\Models;

use Opis\Database\Database;
use Opis\Database\Connection;

  abstract class Model
{
    private $db;
    private $table;

      /**
       * @param $db
       * @param $table
       */
      public function __construct()
      {
          $connection = new Connection(
              'pgsql:host=localhost;dbname=WEB',
              'kren66',
              'kren66'
          );

          $this->db = new Database($connection);
          $this->table = '';
      }

      public function getAll()
      {
          return $this->db->from($this->table)
              ->select()
              ->fetchAssoc()
              ->all();
      }

      public function getById($id)
      {
          return  $this->db->from($this->table)
              ->where('id')->is($id)
              ->select()
              ->fetchAssoc()
              ->first();
      }

      /**
       * @param string $table
       */
      public function setTable(string $table): void
      {
          $this->table = $table;
      }



  }