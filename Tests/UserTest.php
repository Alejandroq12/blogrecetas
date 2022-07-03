<?php
use PHPUnit\Framework\TestCase;

final class UserTest extends TestCase{
    private $op;

    // public function setUp():void
    // {
    //     $this->op = new User;
    // }

    //tests

    public function testUserNameType() : void{
        $this->assertIsNumeric(User::existsEmail('bportillo701@gmail.com'));
    }
    public function testGetUsernameMatch() : void{
        $this->assertEquals('root',User::getUsername(37));
    }
    public function testGetUsernameType() : void{
        $this->assertIsString(User::getUsername(37));
    }
    public function testGetUserImagePathMatch() : void{
        $this->assertEquals('https://i.imgur.com/GvUsGWz.jpg',User::getUserImagePath(37));
    }
    public function testGetUserImagePathType() : void{
        $this->assertIsString(User::getUserImagePath(37));
    } 
    public function testGetUserRolMatch() : void{
        $this->assertEquals('2',User::getUserRol(37));
    }
    public function testGetUserRolType() : void{
        $this->assertIsNumeric(User::getUserRol(37));
    }
    public function testGetUserEmailType() : void{
        $this->assertIsString(User::getUserEmail(37));
    }
    public function testGetUserEmailMetch() : void{
        $this->assertEquals('bportillo701@gmail.com',User::getUserEmail(37));
    }
    public function testEncpassword() : void{
        $this->assertIsString(User::encPass('JonhDoe'));
    }
    public function testExistsUser() : void{
        $this->assertIsNumeric(User::existsUser('root'));
    }
    public function testExistsEmailtype() : void{
        $this->assertIsNumeric(User::existsEmail('bportillo701@gmail.com'));
    }
    public function testExistsEmailMatch() : void{
        $this->assertEquals(1,User::existsEmail('bportillo701@gmail.com'));
    }
    public function testVerifyUserEmailtype() : void{
        $this->assertIsNumeric(User::verifyUserEmail('bportillo701@gmail.com'));
    }
    public function testVerifyUserEmailMatch() : void{
        $this->assertEquals(1,User::verifyUserEmail('bportillo701@gmail.com'));
    }
    public function testGetUserPassword() : void{
        $this->assertIsString(User::getUserPassword('bportillo701@gmail.com'));
    }
    public function testGetUserbyEmailUser() : void{
        $this->assertIsArray(User::getUserbyEmailUser('bportillo701@gmail.com'));
    }
}
?>