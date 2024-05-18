<?php
defined('BASEPATH') OR exit('No direct script access allowed');

//Layout: Header
$this->load->view('layout/header'); ?>

	<meta http-equiv="refresh" content="3;URL=<?php echo route('admin/cloudData/'.$studentID); ?>">	
	<style type="text/css">
		@import url(https://fonts.googleapis.com/css?family=Oswald:400,300,700);
		html,body{
			height: 100%;
		}
		h1{
			font-family: 'Oswald', sans-serif;
			font-weight: 700;
			font-size: 2.8em;
		}
		h3{
			color: #A7A280;
			font-family: 'Oswald', sans-serif;
			font-size: 1em;
			letter-spacing: 1px;
		}
		a{
			color: #000;
			text-decoration: underline;
		}
		a:hover{
			text-decoration: none;
		}
		u{
			color: red;
		}
	</style>
	
	<table width="100%" height="100%">
		<tbody>
			<tr>
				<td align="center">
					<div style="text-align: center;">
						<img src="<?php echo get_asset('img', 'loading.gif'); ?>" alt="Loading">
						<h1>HATA!!! İZİN VERİLEN DOSYALAR <u>JPG, JPEG, PNG, GIF & PDF</u> UZANTILI OLMALIDIR.</h1>
						<h2>yönlendiriliyorsunuz... <a href="<?php echo route('admin/cloudData/'.$studentID); ?>">giriş sayfası</a></h2>
					</div>
				</td>
			</tr>
		</tbody>
	</table>

<?php
//Layout: Footer
$this->load->view('layout/footer');

/* End of file loading.php */
/* Location: ./application/views/loading.php */