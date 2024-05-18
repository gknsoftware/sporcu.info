<!DOCTYPE HTML>
<html lang="en-US">
<head>
    <meta charset="UTF-8">
    <title>Tablo Uygulaması</title>
</head>
<body>
<table border="2">
   <table border="2" width="995px">
    <tr>
       <td rowspan="3" > <img src="http://www.sporcu.info/bld.png"> </td>
       <td align="center" width="723px"><h3>KEÇİÖREN BELEDİYE</h3></td>
	   <td rowspan="3"> <img src="http://www.sporcu.info/bglm.png">  </td>
     </tr>
    <tr>
        <td  align="center" ><h3>ETLİK OLİMPİK YÜZME HAVUZU VE SPOR MERKEZİ</h3></td>
    </tr>
    <tr>
        <td  align="center"><h3>KURSİYER KAYIT FORMU</h3></td>
    </tr>
	</table>
	
	<table border="2" width="995px" cellpadding="5" style="margin-top: 5px;">
    <tr>
        <td align="left" width="100px"><strong>KURS GÜNLERİ</strong></td>
        <td width="350px">   </td>
        <td width="100px" rowspan="3" style="text-align:center"><img src="http://www.sporcu.info/<?php echo $this->pic; ?>" alt="Vesikalık" width="120" height="140"></td>
    </tr>

    <tr>
        <td  align="left"><strong>YÜZME GRUBU</strong></td>
        <td><?php echo $this->model_user->get_student_info($get_id, 'groupname'); ?></td>
    </tr>
    <tr>
        <td height="100px"> </td>
        <td></td>
     
    </tr>
    <tr>
        <td><strong>SPORCUNUN</strong></td>
        <td colspan="2">Lisans: <?php echo $this->lisance_pure; ?></td>
    </tr>
    <tr>
        <td><strong>T.C. KİMLİK NO</strong></td>
        <td colspan="2"><?php echo $this->tcno; ?></td>
    </tr>
    <tr>
        <td><strong>ADI SOYADI</strong></td>
        <td colspan="2"><?php echo $this->name .' '. $this->surname .'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'. $this->birthdate; ?></td>
    </tr>
    <tr>
        <td><strong>TELEFONU</strong></td>
        <td colspan="2"><?php echo $this->newFormatMobile; ?></td>
    </tr>
    <tr>
        <td><strong>BABA / ANNE ADI</strong></td>
        <td colspan="2"><?php echo $this->father; ?> / <?php echo $this->mother; ?></td>
    </tr>
    <tr>
        <td width="100px" ><strong>ADRES</strong></td>
        <td height="75px" colspan="2"><?php echo $this->address; ?></td>
    </tr>
</table>
<table width="995px"  border="2" style="margin-top: 5px;">
    <tr>
        <td colspan="3 width="350px" height="75px" valign="top">GEÇİRDİĞİ HERHANGİ BİR  HASTALIK-AMELİYET VARSA YAZINIZ</td>
    </tr>
 	</table>

<table width="995px"  border="2" style="margin-top: 5px;">
    <tr>
        <td align="center" colspan="3 width="350px"">SAĞLIK BEYANI</td>
        </tr>
    <tr>
        <td colspan="3" style="padding: 10px;">Oğlum / Kızım ___________________________________________________'in Sağlık yönünden beden eğitimi ve spor faaliyeti yapmasına engel bir halinin bulunmadığını beyan ederim.
        <p>____/____/20____&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Velisi :____________________________________  İmza</p>
        </td>
    </tr>
	</table>
	<table border="2" width="995px" style="margin-top: 5px;">
<tr> <td align="center" colspan="3">LÜTFEN KURALLARI DİKKATLE OKUYUP İMZALAYINIZ</td> </tr>
<tr> <td  colspan="3">1. Havuza MAYO, TERLİK, BONE, HAVLU olmadan kesinlikle ALINMAMAKTADIR.      
 </td> </tr>
<tr> <td  colspan="3">2. Çocuk kursiyer velilerinin soyunma odalarına inmesi YASAKTIR.</td> </tr>
<tr> <td  colspan="3">3. Sağlık problemleri hariç ücret iadesi talep EDİLEMEZ.</td> </tr>
<tr> <td  colspan="3">4. Eğitim esnasında tarafınızdan oluşan sorunlar tesbit edildiği takdirde kursiyerliğiniz İPTAL EDİLECEKTİR.</td></tr>
<tr> <td  colspan="3">5. Günlük ders süreniz 1 saattir. Kurs bitiminde havuzdan çıkmamız GEREKMEKTEDİR. Havuza herhangi bir misafir getirmek söz konusu DEĞİLDİR.</td></tr>
<tr> <td colspan="3"> Kurslarla ve Antrenörlerle ilgili herhangi bir sorunda üst kattaki kulüp personelleriyle irtibata geçmeniz rica olunur.</td></tr>
<tr> <td colspan="3">Kayıt esnasında verilen makbuzları kurs bitimine kadar saklayınız.</td></tr>
<tr> <td height="55px"colspan="3" valign="top">YUKARIDA BELİRTİLEN KURALLARI ONAYLIYORUM&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;VELİ ADI SOYADI İMZA</td></tr>
  </table>
<table  border="2" style="margin-top: 5px;">
    <tr align="center">
        <td width="85px" >           </td>
        <td width="85px" >FİŞ.NO     </td>
        <td width="85px" >TARİH      </td>
        <td width="100px" >TUTARI     </td>
        <td width="100px" >TESLİM ALAN</td>
        <td width="15px" >           </td>
        <td width="85px" >           </td>
        <td width="85px" >FİŞ NO     </td>
        <td width="85px" >TARİH      </td>
        <td width="100px" >TUTARI     </td>
        <td width="100px" >TESLİM ALAN</td>
    </tr>
        <tr align="center">
        <td width="85px" >OCAK</td>
        <td width="85px" ></td>
        <td width="85px" ></td>
        <td width="100px" ></td>
        <td width="100px" ></td>
        <td width="15px" ></td>
        <td width="85px" >TEMMUZ</td>
        <td width="85px" ></td>
        <td width="85px" ></td>
        <td width="100px" ></td>
        <td width="100px" ></td>
    </tr>
      </tr>
        <tr align="center">
        <td width="85px" >ŞUBAT</td>
        <td width="85px" ></td>
        <td width="85px" ></td>
        <td width="100px" ></td>
        <td width="100px" ></td>
        <td width="15px" ></td>
        <td width="85px" >AĞUSTOS</td>
        <td width="85px" ></td>
        <td width="85px" ></td>
        <td width="100px" ></td>
        <td width="100px" ></td>
    </tr>
      </tr>
        <tr align="center">
        <td width="85px" >MART</td>
        <td width="85px" ></td>
        <td width="85px" ></td>
        <td width="100px" ></td>
        <td width="100px" ></td>
        <td width="15px" ></td>
        <td width="85px" >EYLÜL</td>
        <td width="85px" ></td>
        <td width="85px" ></td>
        <td width="100px" ></td>
        <td width="100px" ></td>
    </tr>
      </tr>
        <tr align="center">
        <td width="85px" >NİSAN</td>
        <td width="85px" ></td>
        <td width="85px" ></td>
        <td width="100px" ></td>
        <td width="100px" ></td>
        <td width="15px" ></td>
        <td width="85px" >EKİM</td>
        <td width="85px" ></td>
        <td width="85px" ></td>
        <td width="100px" ></td>
        <td width="100px" ></td>
    </tr>
      </tr>
        <tr align="center">
        <td width="85px" >MAYIS</td>
        <td width="85px" ></td>
        <td width="85px" ></td>
        <td width="100px" ></td>
        <td width="100px" ></td>
        <td width="15px" ></td>
        <td width="85px" >KASIM</td>
        <td width="85px" ></td>
        <td width="85px" ></td>
        <td width="100px" ></td>
        <td width="100px" ></td>
    </tr>
      </tr>
        <tr align="center">
        <td width="85px" >HAZİRAN</td>
        <td width="85px" ></td>
        <td width="85px" ></td>
        <td width="100px" ></td>
        <td width="100px" ></td>
        <td width="15px" ></td>
        <td width="85px" >ARALIK</td>
        <td width="85px" ></td>
        <td width="85px" ></td>
        <td width="100px" ></td>
        <td width="100px" ></td>
    </tr>
</table>
</table>


</body>