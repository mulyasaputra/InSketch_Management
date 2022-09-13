<?php 
require '../logic/function.php';

if(isset($_GET["id"])){
    $id = $_GET["id"];
    if ( delete($id) > 0 ){
        echo "<script> alert('Data berhasil di hapus');
        document.location.href = '../?url=activities';</script>";
    } else {
        echo "<script> alert('Dada gagal di hapus');
        document.location.href = '../?url=activities';</script>";
    }
    exit;
} elseif (isset($_GET["remove"])){
    $remove = $_GET["remove"];
    if ( remove($remove) > 0 ){
        echo "<script> alert('Data berhasil di hapus');
        document.location.href = '../?url=wallets';</script>";
    } else {
        echo "<script> alert('Dada gagal di hapus');
        document.location.href = '../?url=wallets';</script>";
    }
}
?>