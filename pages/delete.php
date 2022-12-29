<?php 
require '../logic/function.php';

if(isset($_GET["id"])){
    $id = $_GET["id"];
    if ( delete($id, 'expenditure') > 0 ){
        echo "<script> alert('Data berhasil di hapus');
        document.location.href = '../?url=activities';</script>";
    } else {
        echo "<script> alert('Dada gagal di hapus');
        document.location.href = '../?url=activities';</script>";
    }
    exit;
} elseif (isset($_GET["remove"])){
    $remove = $_GET["remove"];
    if ( delete($remove, 'finance') > 0 ){
        echo "<script> alert('Data berhasil di hapus');
        document.location.href = '../?url=wallets';</script>";
    } else {
        echo "<script> alert('Dada gagal di hapus');
        document.location.href = '../?url=wallets';</script>";
    }
} elseif (isset($_GET["spend"])){
    $spend = $_GET["spend"];
    if ( delete($spend, 'savings_out') > 0 ){
        echo "<script> alert('Data berhasil di hapus');
        document.location.href = '../?url=savings';</script>";
    } else {
        echo "<script> alert('Dada gagal di hapus');
        document.location.href = '../?url=savings';</script>";
    }
} elseif (isset($_GET["fbIncome"])){
    $fbIncome = $_GET["fbIncome"];
    if ( delete($fbIncome, 'savings') > 0 ){
        echo "<script> alert('Data berhasil di hapus');
        document.location.href = '../?url=savings';</script>";
    } else {
        echo "<script> alert('Dada gagal di hapus');
        document.location.href = '../?url=savings';</script>";
    }
}
?>