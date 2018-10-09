<?php
$kode_bahasa = '';

switch ($tujuan) {
  case 'inggris':
  case 'english':
  case 'uk':
  case 'england':
    $kode_bahasa = 'en';
    break;

  case 'belanda':
  case 'netherland':
    $kode_bahasa = 'nl';
    break;

    case 'italia':
      $kode_bahasa = 'it';
      break;

      case 'cina':
      case 'china':
      case 'chinese':
      case 'mandarin':
        $kode_bahasa = 'zh';
        break;

        case 'korea':
        case 'hangul':
        case 'hanggul':
        case 'korsel':
          $kode_bahasa = 'ko';
          break;

case 'indonesia':
  $kode_bahasa = 'id';
  break;

    default:
    $kode_bahasa = 'null';
    break;
}

 ?>
