<?php
    include_once("../sabitler/standardsStudents.php");

    $soruid = htmlentities($_GET['soruid'], ENT_QUOTES, "UTF-8");
    $ogrencicevap = htmlentities($_GET['ogrencicevap'], ENT_QUOTES, "UTF-8");

    
    $sql = mysqli_query(baglanti(),"Select * from sorular Where id = '$soruid'");
    $row=mysqli_fetch_array($sql);

    $soru = $row['soru'];
    $resim = $row['resim'];
    $cevap = $row['cevap'];
    $secenek1 = $row['secenek1'];
    $secenek2 = $row['secenek2'];
    $secenek3 = $row['secenek3'];
    $secenekler = $row['secenekler'];
    $soru = str_replace("\n", '<br>', $soru);
    $cevap = str_replace("\n", '<br>', $cevap);
    $secenek1 = str_replace("\n", '<br>', $secenek1);
    $secenek2 = str_replace("\n", '<br>', $secenek2);
    $secenek3 = str_replace("\n", '<br>', $secenek3);

    $siklar[0] = array($cevap, $secenek1, $secenek3, $secenek2);
    $siklar[1] = array($secenek1, $cevap, $secenek2, $secenek3);
    $siklar[2] = array($secenek2, $secenek3, $cevap, $secenek1);
    $siklar[3] = array($secenek3, $secenek2, $secenek1, $cevap);

    $color[0] = "";
    $color[1] = "";
    $color[2] = "";
    $color[3] = "";

    $color[$ogrencicevap] = "danger";
    $color[$secenekler] = "success";

    ?>
    <div class="studentTest">
        <div class="testQuestion border rounded p-4 m-2">
            <div class="resultQuestion">
                <?php if($resim != "BOŞ") {?>
                    <img class="mb-4" src="../admin/uploads/<?php echo $resim ?>" width="100%" height="300px" alt="soru resmi">
                <?php } ?>
                <p><?php echo $soru; ?></p>
                <hr width="50%" >
                <ul>
                    <li><div class="w-100 mt-3"><a class="option <?php echo "text-$color[0]";?>" ><?php echo "A) " . $siklar[$secenekler][0]; ?></a></div></li>
                    <li><div class="w-100 mt-3"><a class="option <?php echo "text-$color[1]";?>" ><?php echo "B) " . $siklar[$secenekler][1]; ?></a></div></li>
                    <li><div class="w-100 mt-3"><a class="option <?php echo "text-$color[2]";?>" ><?php echo "C) " . $siklar[$secenekler][2]; ?></a></div></li>
                    <li><div class="w-100 mt-3"><a class="option <?php echo "text-$color[3]";?>" ><?php echo "D) " . $siklar[$secenekler][3]; ?></a></div></li>
                </ul>
            </div>
        </div>
    </div>