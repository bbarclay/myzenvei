<?php

class HSBC{

  private $cpiKey ='zEeWQNKelqPE2DRFueuDq1QrASjux2lM';  // YOUR own hash
  private $_fldif;
  private $a;

  function __construct(){
    $s = 'KmJTwzVPwjoxQdWJb1BxbuhBSa2RuM05+/aUdgYoGdFWWf04CKIQTxtxLeKCp+5J';
    $s1 = 'y8YhmjsAoMUW9RxfXBSos0A6LwGd+5pXv/MRAKCYFLG';
    $s2 = 'BqRkPAG8DFFAdeN5SMAArktCYuUGXi2q88EDoOs3Ykw0k';
    $this->a = chr(98).chr(84).chr(120).chr(114).chr(66).chr(87).chr(80).chr(112);

    $this->_fldif = $this->initKey($s, $s1, $s2);
    $this->_fldif = substr($this->_fldif,0,44);
  }

  public function GenerateHash($vector){

    $vector1 = array();
    for($i = 0; $i < sizeof($vector); $i++)
    {
      $flag = false;
      $s2 = $vector[$i];
      $vSize= sizeof($vector1);
      for($k = 0; $k < $vSize && !$flag; $k++)
      {
        $s4 = $vector1[$k];
        $l = strcmp($s2, $s4);
        if($l <= 0)
        {
          array_push($vector1, '');
          for($r = sizeof($vector1)-2; $r >= $k; $r--)
          $vector1[$r+1] = $vector1[$r];

          $vector1[$k] = $s2;
          $flag = true;
        }
      }

      if(!$flag) array_push($vector1, $s2);
    }

    $s1 = '';
    for($j = 0; $j < sizeof($vector1); $j++)
    {
      $s3 = $vector1[$j];
      $s1 = $s1 . $s3;
    }

    $abyte0 = $this->decryptToBinary($this->cpiKey);

    $ret = base64_encode(mhash(MHASH_SHA1, $s1.$abyte0, $abyte0));
    return $ret;
  }

  private function rot13(&$abyte0)
  {
    for($i = 0; $i < strlen($abyte0); $i++)
    {
      $c = ord($abyte0[$i]);
      if($c >= ord('a') && $c <= ord('m') || $c >= ord('A') && $c <= ord('M'))
      $abyte0[$i] = chr($c + 13);
      else
      if($c >= ord('n') && $c <= ord('z') || $c >= ord('N') && $c <= ord('Z'))
      $abyte0[$i] = chr($c - 13);
    }
  }

  private function encode($abyte0) {
    return base64_encode($abyte0);
  }

  private function decode($s) {
    return base64_decode($s);
  }

  private function encrypt($abyte0, $abyte1)
  {
    $td = mcrypt_module_open (MCRYPT_DES, '', MCRYPT_MODE_CBC, '');
    $iv = $this->a;
    $ks = mcrypt_enc_get_key_size ($td);
    $key = substr($abyte1, 0, $ks);

    /* Intialize encryption */
    mcrypt_generic_init ($td, $key, $iv);
    return mcrypt_generic ($td, $abyte0);
  }

  private function decrypt($abyte0, $abyte1)
  {
    $td = mcrypt_module_open (MCRYPT_DES, '', MCRYPT_MODE_CBC, '');
    $iv = $this->a;
    $ks = mcrypt_enc_get_key_size ($td);
    $key = substr($abyte1, 0, $ks);

    /* Intialize encryption */
    mcrypt_generic_init ($td, $key, $iv);
    $ret = mdecrypt_generic($td, $abyte0);

    while($ret[strlen($ret)-1] == "\4" && strlen($ret) > 0){
      $ret=substr($ret, 0, strlen($ret)-1);
    }
    return $ret;
  }

  private function encryptEncode($abyte0, $abyte1)
  {
    return $this->encode($this->encrypt($abyte0, $abyte1));
  }

  private function decodeDecrypt($s, $abyte0)
  {
    return $this->decrypt($this->decode($s), $abyte0);
  }

  private function initKey($s, $s1, $s2)
  {
    $abyte0 = chr(0);
    $abyte1 = $s1;
    $abyte2 = $s2;
    $byte0 = 4;
    $i = $byte0 + 9;
    $j = rand(0, 30);
    $j = 0;
    if($j > $byte0 * $i) $j -= $byte0 * $i;

    $k = 0;
    for($l = 0; $l < $byte0 * $i; $l++)
    {
      switch(($j + $l) % $i)
      {
        case 0: // '\0'
        if($k == 2)
        {
          $abyte0 = $this->encrypt($abyte1, $abyte2);
          $k++;
        }
        break;

        case 1: // '\001'
        if($k == 1)
        {
          $abyte2 = $abyte1;
          $this->rot13($abyte2);
          $k++;
        }
        break;

        case 2: // '\002'
        if($k == 0)
        {
          $i1 = 48 + (ord($abyte1[0]) + 10) % 10;
          $abyte1[0] = chr($i1);
          $k++;
        }
        break;

        case 3: // '\003'
        if($k == 3) $k++;
        break;

        case 5: // '\005'
        case 7: // '\007'
        case 10: // '\n'
        if($k < 2) $abyte0 = $this->encrypt($abyte1, $abyte2);
        break;

        case 4: // '\004'
        case 6: // '\006'
        case 8: // '\b'
        case 9: // '\t'
        default:
          break;
      }
    }
    return $this->decodeDecrypt($s, $abyte0);
  }

  public function decryptToBinary($s)
  {
    if ($s == NULL)
    return NULL;
    else
    return $this->decodeDecrypt($s, $this->_fldif);
  }

}

?>