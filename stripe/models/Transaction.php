<?php
  class Transaction {
    private $db;

    public function __construct() {
      $this->db = new Database;
    }

    public function addTransaction($data) {

      $oneYearOn = date('Y-m-d',strtotime(date("Y-m-d", mktime()) . " + 365 day"));
      // Prepare Query
      $this->db->query('INSERT INTO transactions (id, customer_id, product, amount, currency, status, user_id, nonvalide) VALUES(:id, :customer_id, :product, :amount, :currency, :status, :user_id , :nonvalide)');

      // Bind Values
      $this->db->bind(':id', $data['id']);
      $this->db->bind(':customer_id', $data['customer_id']);
      $this->db->bind(':product', $data['product']);
      $this->db->bind(':amount', $data['amount']);
      $this->db->bind(':currency', $data['currency']);
      $this->db->bind(':status', $data['status']);
      $this->db->bind(':user_id', $data['user_id']);
      $this->db->bind(':nonvalide', $oneYearOn);
      // Execute
      if($this->db->execute()) {

        return true;

      } else {
        return false;
      }

    }


    public function updateTransaction($id) {

    $oneYearOn = date('Y-m-d',strtotime(date("Y-m-d", mktime()) . " + 365 day"));

      // Prepare Query
      $this->db->query('UPDATE transactions SET nonvalide = :nonvalide WHERE id = :id');

      // Bind Values
      $this->db->bind(':id', $id);
      $this->db->bind(':nonvalide', $oneYearOn);

      if($this->db->execute()) {
        return true;
      } else {
        return false;
      }
    }

    public function getTransactions() {

      $this->db->query('SELECT * FROM transactions ORDER BY created_at DESC');

      $results = $this->db->resultset();

      return $results;
    }
  }
