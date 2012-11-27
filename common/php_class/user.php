<?php
	class User
	{
		private $id;
		private $username;
		private $first_name;
		private $last_name;
		private $middle_name;
		private $date_of_birth;
		private $email;
		private $type;

		public function User($id, $username,$first_name,$last_name,$middle_name,$date_of_birth,$email,$type)
		{

			$this->id =$id;
			$this->username=$username;
			$this->first_name=$first_name;
			$this->last_name=$last_name;
			$this->middle_name=$middle_name;
			$this->date_of_birth=$date_of_birth;
			$this->email=$email;
			$this->type=$type;
		}
		public function setUsername($value)
		{
			$this->username = $value;
		}
		public function setEmail($value)
		{
			$this->email = $value;
		}

		public function getID()
		{
			return $this->id;
		}
		public function getUsername()
		{
			return $this->username;
		}
		public function getFirstName()
		{
			return $this->first_name;
		}
		public function getLastName()
		{
			return $this->last_name;
		}
		public function getMiddleName()
		{
			return $this->middle_name;
		}
		public function getDateOfBirth()
		{
			return $this->date_of_birth;
		}
		public function getEmail()
		{
			return $this->email;
		}
		public function getType()
		{
			return $this->type;
		}
	}
?>