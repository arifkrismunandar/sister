<?php
if (!isset($_SESSION['id_admin'])) {
   header('location: ../');
}

if (isset($_GET['action'])) {

   switch ($_GET['action']) {
      case 'tambah':
         include('./kandidatrw/add.php');
         break;

      case 'edit':
         include('./kandidatrw/edit.php');
         break;

      case 'view':
         include('./kandidatrw/view.php');
         break;

      case 'hapus':

         if (isset($_GET['id'])) {

            $id   = $_GET['id'];

            $sql   = $con->prepare("SELECT foto FROM t_kandidatrw WHERE id_kandidatrw = ?");
            $sql->bind_param('s', $id);
            $sql->execute();
            $sql->store_result();
            $sql->bind_result($f);
            $sql->fetch();
            unlink('../assets/img/kandidatrw/'.$f);

            $sql   = $con->prepare("DELETE FROM t_kandidatrw WHERE id_kandidatrw = ?");
            $sql->bind_param('s', $id);
            $sql->execute();

            header('location: ?page=kandidatrw');

         } else {

            header('location: ./');

         }

         break;
      default:
         include('./kandidatrw/list.php');
         break;
   }

} else {

   include('./kandidatrw/list.php');

}
?>
