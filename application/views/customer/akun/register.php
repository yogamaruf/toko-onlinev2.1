<div class="row">

	<div id="sidebar" class="span3">

		<div class="well well-small">

			<ul class="nav nav-list">
		
				<?php foreach ($list->result_array() as $key => $value) { ?>

					<li>
						<a href="<?php echo base_url('index.php/toko/detaillist/').$value['idkategori']; ?>"><span class="icon-chevron-right"></span><?php echo $value['namakategori']; ?></a>
					</li>

				<?php } ?>

				<li style="border:0"> &nbsp;</li>
				<li> 
					<a class="totalInCart" href="<?php echo base_url('index.php/toko/keranjang'); ?>"><strong>Total <span class="badge badge-warning pull-right" style="line-height:18px;">Rp. 0</span></strong></a>
				</li>

			</ul>
			
		</div>

		<div class="well well-small alert alert-warning cntr">
			<h2>50% Discount</h2>
				<p> 
					only valid for online order. <br><br><a class="defaultBtn" href="#">Click here </a>
				</p>
		</div>

		<div class="well well-small" >
			<a href="#"><img src="<?php echo base_url(); ?>assets/fronted/assets/img/paypal.jpg" alt="payment method paypal"></a>
		</div>
			
		<a class="shopBtn btn-block" href="#">Upcoming products <br><small>Click to view</small></a><br><br>

		<ul class="nav nav-list promowrapper">

			<?php 
		  		$record = $this->db->query('SELECT * FROM produk LIMIT 3,3'); 
		  		foreach ($record->result_array() as $key => $value) { 
		  	?>

				<li>
				 	<div class="thumbnail">
						<a class="zoomTool" href="<?php echo base_url('index.php/toko/detailproduk/').$value['idproduk']; ?>" title="add to cart"><span class="icon-search"></span> QUICK VIEW</a>
						<img style="width: 210px;height: 270px;" src="<?php echo base_url(); ?>assets/gambar/produk/<?php echo $value['foto']; ?>" alt="bootstrap ecommerce templates">
							<div class="caption">
				  				<h4 style="padding: 0;"><a class="defaultBtn" href="<?php echo base_url('index.php/toko/detailproduk/').$value['idproduk']; ?>">VIEW</a><span class="pull-right" style="font-size: 16px;">Rp. <?php echo number_format($value['harga'],0,'.','.'); ?></span>
				  				</h4>
							</div>
					</div>
				</li>

				<li style="border:0"> &nbsp;</li>

			<?php } ?>

		</ul>

	</div>

	<div class="span9">

    	<ul class="breadcrumb">
			<li><a href="<?php echo base_url('index.php/toko/');?>">Home</a> <span class="divider">/</span></li>
			<li class="active"><?php echo $title['judulhal'];?></li>
    	</ul>

		<h3><?php echo $title['judulhal'];?></h3>	

		<hr class="soft"/>

		<div class="well">

			<form class="form-horizontal" action="<?php echo base_url('index.php/toko/tambahcustomer'); ?>" method="POST">

				<h3><?php echo $title1['judulhal'];?></h3>

				<input type="hidden" name="user">
				<div class="control-group">
					<label class="control-label">Title <sup>*</sup></label>
					<div class="controls">
						<select class="span1" name="title">
							<option value="">-</option>
							<option value="1">Mr.</option>
							<option value="2">Mrs</option>
							<option value="3">Miss</option>
						</select>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="inputFname">First name <sup>*</sup></label>
					<div class="controls">
			  			<input type="text" id="inputFname" name="namad" placeholder="First Name">
					</div>
		 		</div>
		 		<div class="control-group">
					<label class="control-label" for="inputLname">Last name <sup>*</sup></label>
					<div class="controls">
			  			<input type="text" id="inputLname" name="namab" placeholder="Last Name">
					</div>
		 		</div>
				<div class="control-group">
					<label class="control-label" for="inputEmail">Email <sup>*</sup></label>
					<div class="controls">
		  				<input type="text" placeholder="Email" name="email">
					</div>
	  			</div>	  
				<div class="control-group">
					<label class="control-label">Password <sup>*</sup></label>
					<div class="controls">
		  				<input type="password" placeholder="Password" name="pass">
					</div>
	  			</div>
				<div class="control-group">
					<label class="control-label">Date of Birth <sup>*</sup></label>
					<div class="controls">
						<input type="date" id="inputLname" name="ttl">
					</div>
	  			</div>
				<div class="control-group">
					<div class="controls">
		 				<input type="submit" name="submitAccount" value="Register" class="exclusive shopBtn">
					</div>
				</div>

			</form>

		</div>

		<!--<div class="well">

			<form class="form-horizontal" >

				<h3>Your Billing Details</h3>

				<div class="control-group">
					<label class="control-label">No. Telp <sup>*</sup></label>
					<div class="controls">
			  			<input type="text" placeholder=" Field name">
					</div>
				</div>
				<div class="control-group">
					<label class="control-label"> <sup>*</sup></label>
					<div class="controls">
			  			<input type="text" placeholder=" Field name">
					</div>
				</div>
		 		<div class="control-group">
					<label class="control-label">Fiels label <sup>*</sup></label>
					<div class="controls">
			  			<input type="text" placeholder=" Field name">
					</div>
				</div>
				<div class="control-group">
					<label class="control-label">Fiels label <sup>*</sup></label>
					<div class="controls">
			  			<textarea></textarea>
					</div>
				</div>
				<div class="control-group">
					<div class="controls">
		 				<input type="submit" name="submitAccount" value="Register" class="shopBtn exclusive">
					</div>
				</div>

			</form>

		</div>-->


		<div class="well">

			<form class="form-horizontal" >

				<h3>Your Account Details</h3>

				<div class="control-group">
					<label class="control-label">No. Telp <sup>*</sup></label>
					<div class="controls">
			  			<input type="text" placeholder=" Field name">
					</div>
				</div>
				<div class="control-group">
					<label class="control-label">No. Rekening <sup>*</sup></label>
					<div class="controls">
			  			<input type="text" placeholder=" Field name">
					</div>
				</div>
				<div class="control-group">
					<label class="control-label">Kewarganegaraan <sup>*</sup></label>
					<div class="controls">
			  			<input type="text" placeholder=" Field name">
					</div>
				</div>
				<div class="control-group">
					<label class="control-label">Kabupaten <sup>*</sup></label>
					<div class="controls">
			  			<input type="text" placeholder=" Field name">
					</div>
				</div>
				<div class="control-group">
					<label class="control-label">Provinsi <sup>*</sup></label>
					<div class="controls">
			  			<input type="text" placeholder=" Field name">
					</div>
				</div>
				<div class="control-group">
					<label class="control-label">Kode POS <sup>*</sup></label>
					<div class="controls">
			  			<input type="text" placeholder=" Field name">
					</div>
				</div>
				<div class="control-group">
					<div class="controls">
		 				<input type="submit" name="submitAccount" value="Register" class="exclusive shopBtn">
					</div>
				</div>

			</form>

		</div>

	</div>

</div>

<section class="our_client">
	<hr class="soften"/>
	<h4 class="title cntr"><span class="text">Manufactures</span></h4>
	<hr class="soften"/>
	<div class="row">

		<?php foreach ($merk as $key => $value) { ?>

			<div class="span2">
				<a href="<?php echo base_url('index.php/toko/detaillist/').$value['idmerk']; ?>"><img alt="" src="<?php echo base_url(); ?>assets/gambar/merk/<?php echo $value['gambar']; ?>"></a>
			</div>

		<?php } ?>
		
	</div>
</section>