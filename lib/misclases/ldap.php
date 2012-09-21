<?php
class ldap
{
	public static function checkPassword($username, $password)
	{

		
		$ds = ldap_connect("192.168.3.5") or die ("No se pudo establecer coneccion con el servidor");
		
		ldap_set_option($ds, LDAP_OPT_PROTOCOL_VERSION, 3);
		
		$ldapbind = @ldap_bind($ds, "uid=$username,ou=Personas,dc=telesur" , $password);
		
		
		if($ldapbind==false){
			
			$a=new Criteria();
			$a->add(sfGuardUserPeer::USERNAME,$username);
			$usr=sfGuardUserPeer::doSelect($a);			
		
			$a=new PluginsfGuardUser();
			$a->setPassword($password);
      			$pass_new= $a->getPassword();
			
			if($usr[0]->getPassword()==$pass_new) return true;
			else return false;
			
		}
		
		else return true;

	}
}
?>
