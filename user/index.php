<?php

session_start();
//cek apakah user sudah login
if(!isset($_SESSION['username'])){
    die("Anda belum login");//jika belum login jangan lanjut..
}

include "../include/config.php";
//cek apakah user sudah login

$sql_ngambil_user = mysql_query( "SELECT * FROM tb_user WHERE uname_user = '$_SESSION[username]' ");
$user=mysql_fetch_object($sql_ngambil_user);
//cek level user
// if($_SESSION['sebagai']!="mahasiswa"){ die("Anda bukan mahasiswa");}//jika bukan admin jangan lanjut

?>

<html>
<head>
<title><?php  echo $site ['judul'];?></title>
</head>
<body>
	<button><a href="../include/logout.php">logout</a></button>
	<button><a href="cat.php">edit category kebutuhan</a></button>
	<button><a href="pend.php">pendapatan dan tabungan</a></button>

	<h3>nama : <?php echo $user->uname_user;?></h3>

	<h2>balance</h2>
	<h3>total harga: Rp. <?php
		
			$sql="SELECT SUM(harga_kpok) AS total FROM tb_kpok WHERE uname_userkpok = '$_SESSION[username]'"; 
			$hasil = mysql_query($sql); 
			$r1=mysql_fetch_assoc($hasil); 
			echo $r1['total'];
		?></h3>
	<h3>total pend: Rp. <?php
		
			$sql="SELECT SUM(jumlah_pend) AS total FROM tb_pend WHERE uname_userpend = '$_SESSION[username]'"; 
			$hasil = mysql_query($sql); 
			$r2=mysql_fetch_assoc($hasil); 
			echo $r2['total'];
		?></h3>




	<div class="foto">
		<?php echo "<td><img src='../images/$user->foto_user'></td>";?>
	</div>
	<!-- read kebutuhan pokok -->
	<div style="float:left;padding: 0 50px;">
	<center>
		<h2>daftar kebutuhan bulanan</h2>
		<table style="border: 1 solid black";>
			<tr >
				<!-- <th style="border: 1px solid black"; >no</th> -->
				<th style="border: 1px solid black"; >kode kpok</th>
				<th style="border: 1px solid black";>nama</th>
				<th style="border: 1px solid black";>jenis</th>
				<th style="border: 1px solid black";>jumlah</th>
				<th style="border: 1px solid black";>harga</th>
				<th style="border: 1px solid black";>note</th>
			</tr>
			<?php

			include "../function/fungsi_user.php";
			tampilkpok();
			?>

		</table>

		
		

		<h2>tambah kebutuhan bulanan</h2>
		<form action="../include/prosescruduser.php" method="POST">
			<table>
				<tr>
					<td>kode kpok</td>
					<td><input type="text" name="kode_kpok" placeholder="hanya untuk hapus/update"></td>
				</tr>	
				<tr>
					<!-- user -->
					<td><input type="hidden" name="uname_userkpok" value="<?php echo $user->uname_user;?>"></td>
				</tr>	
				<tr>
					<td>kategory</td>
					<td>
					<select name="jenis_kpok">
						<option>--</option>
						<?php tampilkatkebopt(); ?>
					</select></td>
				</tr>	

				<tr>
					<td>namakeb</td>
					<td><input type="text" name="nama_kpok" placeholder="spp"></td>
				</tr>
				<tr>
					<td>jumlah</td>
					<td><input type="text" name="jumlah_kpok" placeholder="1"></td>
				</tr>	
				<tr>
					<td>harga</td>
					<td><input type="text" name="harga_kpok" placeholder="Rp.10.000"></td>
				</tr>
				<tr>
					<td>note</td>
					<td><input type="text" name="note_kpok"></td>
				</tr>
			</table>
			<input type="submit" name="tambah" value="tambah">
			<input type="submit" name="update" value="update">
			<input type="submit" name="hapus" value="hapus">
			<input type="reset">
		</form>
	</center>
	</div>


	<!-- read kebutuhan sekunder -->
	<!-- <hr>  -->
	<div style="float:left ;padding: 0 50px;">
	<center>
		<h2>daftar kebutuhan sekunder</h2>
		<table style="border: 1 solid black";>
			<tr >
				<!-- <th style="border: 1px solid black"; >no</th> -->
				<th style="border: 1px solid black"; >kode ksek</th>
				<th style="border: 1px solid black";>nama</th>
				<th style="border: 1px solid black";>jenis</th>
				<th style="border: 1px solid black";>jumlah</th>
				<th style="border: 1px solid black";>harga</th>
				<th style="border: 1px solid black";>note</th>
			</tr>
			<?php
			tampilksek();
			?>
		</table>
		<h3>total harga:<?php
		
			$sql="SELECT SUM(harga_ksek) AS total FROM tb_ksek WHERE uname_userksek = '$_SESSION[username]'"; 
			$hasil = mysql_query($sql); 
			$r=mysql_fetch_assoc($hasil); 
			echo $r['total'];
		?></h3>
		<h3>last update:<?php?></h3>

		<h2>tambah kebutuhan sekunder</h2>
		<form action="../include/prosescruduser.php" method="POST">
			<table>
				<tr>
					<td>kode ksek</td>
					<td><input type="text" name="kode_ksek" placeholder="hanya untuk hapus/update"></td>
				</tr>	
				<tr>
					<!-- user -->
					<td><input type="hidden" name="uname_userksek" value="<?php echo $user->uname_user;?>"></td>
				</tr>
				<tr>
					<td>kategori</td>
					<td>
					<select name="jenis_ksek">
						<option value="No" placeholder="makanan">--</option>
						<option value="pakaian">pakaian</option>
						<option value="kampus">kampus</option>
					</select></td>
				</tr>	
				<tr>
					<td>namakeb</td>
					<td><input type="text" name="nama_ksek" placeholder="sabun" ></td>
				</tr>
				<tr>
					<td>jumlah</td>
					<td><input type="text" name="jumlah_ksek" placeholder="1"></td>
				</tr>	
				<tr>
					<td>harga</td>
					<td><input type="text" name="harga_ksek" placeholder="Rp.10.000"></td>
				</tr>
				<tr>
					<td>note</td>
					<td><input type="text" name="note_ksek"></td>
				</tr>
			</table>
			<input type="submit" name="tambahksek" value="tambah">
			<input type="submit" name="updateksek" value="update">
			<input type="submit" name="hapusksek" value="hapus">
			<input type="reset">
		</form>
	</center>
	</div>


</body>
</html>

