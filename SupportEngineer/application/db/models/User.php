<?php
namespace SupportTest\db\models;

/**
 * @Entity @Table(name="users")
 **/
class User
{
    /** @Id @Column(type="integer") @GeneratedValue **/
    protected $id;
    
    /** @Column(type="string") **/
    protected $email;
    
    /** @Column(type="string") **/
    protected $password;

    public function getId()
    {
        return $this->id;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }
    
    public function getEmail()
    {
        return $this->email;
    }

    public function setPassword($password)
    {
        $this->password = $password;
    }
    
    public function getPassword()
    {
        return $this->password;
    }
}