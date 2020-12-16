<!DOCTYPE html>
<html lang="hu">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="images/favicon.ico">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <link href="https://kit-pro.fontawesome.com/releases/v5.15.1/css/pro.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <title>MyBurger</title>
</head>

<body>

    <!-- 
    ##
    ##       Navigáció
    ##     
    -->


    <nav class="navbar navbar-expand-lg sticky-top navbar-light">
        <div class="logo">
            <i class="fas fa-hamburger fa-2x"></i>
            <a href="index.php">
                <h3>MyBurger</h3>
            </a>
        </div>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <div class="theme-changer">
                        <a onclick="toggleTheme()"><i class="fas fa-lightbulb-on fa-2x "></i></a>
                    </div>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="#">Főoldal <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#hamburgerkeszites">Hamburger készítés</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#masok-hamburger">Mások hamburgerei</a>
                </li>
            </ul>
        </div>
    </nav>



    <h1 id="main-text">Készítsd el a saját hamburgered!</h1>


    <div class="fokep"></div>



    <!-- 
    ##
    ##       Hamburger készítés 
    ##     
    -->

    <main>
        <form action="upload.php" method="GET">

            <div class="osszegjelzo">
                Ár:
                <span id="osszegtext"></span>
                <input type="number" class="osszeg" value="0" name="osszeg">
                FT
            </div>

            <div class="burgerinfo">

                <!--    Hiba üzenetek    -->

                <?php
                if (isset($_GET['hibaNev'])) {
                    $hibaNev = $_GET['hibaNev'];
                    echo "<h1 class='hiba'>$hibaNev</h1>";
                }

                if (isset($_GET['siker'])) {
                    $siker = $_GET['siker'];
                    echo "<h1 class='siker'>$siker</h1>";
                }
                ?>
                <!--    Hiba üzenetek    -->

                <!--    Hamburger név     -->
                <label id="hamburgerkeszites" for="burgernev">Hamburgered neve:</label>
                <div class="nev">
                    <input placeholder="Név.." type="text" id="burgernev" name="burgernev" autofocus>
                    <input type="button" id="nevgenerator" value="Név generátor" onclick="nevGeneralas('burgernev')">
                </div>

            </div>

            <!--    Feltét     -->
            <h3 class="category-text"><i class="far fa-cheese-swiss p-2"></i>Feltét</h3>


            <div class="feltet">
                <div class="item">
                    <span> Sajt (+120FT)</span>
                    <img src="images/cheese.png" alt="Sajt">
                    <div class="controls">
                        <input type="button" onclick="dbCsokkent('dbSajt')" value="-">
                        <input class="fofeltet" readonly="readonly" type="number" data-ar="120" min="0" max="10" name="dbSajt" id="dbSajt" value="0">
                        <input onclick="dbNovel('dbSajt')" type="button" value="+">
                    </div>
                </div>
                <div class="item">
                    <span> Bacon (+130FT)</span>
                    <img src="images/bacon.png" alt="Bacon">
                    <div class="controls">
                        <input type="button" onclick="dbCsokkent('dbBacon')" value="-">
                        <input class="fofeltet" readonly="readonly" type="number" data-ar="130" min="0" max="10" name="dbBacon" id="dbBacon" value="0">
                        <input onclick="dbNovel('dbBacon')" type="button" value="+">
                    </div>
                </div>

                <div class="item">
                    <span> Húspogácsa (+250FT)</span>
                    <img src="images/burger.png" alt="Burger">
                    <div class="controls">
                        <input type="button" onclick="dbCsokkent('dbHus')" value="-">
                        <input class="fofeltet" readonly="readonly" type="number" data-ar="250" min="0" max="10" name="dbHus" id="dbHus" value="0">
                        <input onclick="dbNovel('dbHus')" type="button" value="+">
                    </div>

                </div>
            </div>
            <!--   (Választható) Feltét     -->

            <h3 class="category-text"><i class="fas fa-bacon p-2"></i>További feltétek</h3>

            <div class="feltet">

                <div class="item" onclick="check('hagyma')">
                    <span>
                        <label for="hagyma">Hagyma(+100FT)</label><br>
                        <img src="images/onion.png" alt="Hagyma">
                    </span>
                    <div class="bottom">
                        <input class="sum" data-ar="100" type="checkbox" name="hagyma">
                    </div>
                </div>

                <div class="item" onclick="check('salata')">
                    <span>
                        <label for="salata">Saláta(+80FT)</label><br>
                        <img src="images/lettuce.png" alt="Saláta">
                    </span>
                    <div class="bottom">
                        <input class="sum" data-ar="80" type="checkbox" name="salata">
                    </div>
                </div>


                <div class="item" onclick="check('paradicsom')">
                    <span>
                        <label for="paradicsom">Paradicsom(+50FT)</label><br>
                        <img src="images/tomato.png" alt="Paradicsom">
                    </span>
                    <div class="bottom">
                        <input class="sum" data-ar="50" type="checkbox" name="paradicsom">
                    </div>
                </div>


                <div class="item" onclick="check('uborka')">
                    <span>
                        <label for="uborka">Uborka(+40FT)</label><br>
                        <img src="images/cucumber.png" alt="Uborka">
                    </span>
                    <div class="bottom">
                        <input class="sum" data-ar="40" type="checkbox" name="uborka">
                    </div>
                </div>


                <div class="item" onclick="check('tojas')">
                    <span>
                        <label for="tojas">Tojás(+150FT)</label><br>
                        <img src="images/egg.png" alt="Tojás">
                    </span>
                    <div class="bottom">
                        <input class="sum" data-ar="150" type="checkbox" name="tojas">
                    </div>
                </div>


                <div class="item" onclick="check('jalapeno')">
                    <span>
                        <label for="jalapeno">Jalapeno(+200FT)</label><br>
                        <img src="images/jalapeno.png" alt="Jalapeno paprika">
                    </span>
                    <div class="bottom">
                        <input class="sum" data-ar="200" type="checkbox" name="jalapeno">
                    </div>
                </div>


                <div class="item" onclick="check('sonka')">
                    <span>
                        <label for="sonka">Sonka(+180FT)</label><br>
                        <img src="images/ham.png" alt="sonka">
                    </span>
                    <div class="bottom">
                        <input class="sum" data-ar="180" type="checkbox" name="sonka">
                    </div>
                </div>

                <div class="item" onclick="check('feta')">
                    <span>
                        <label for="feta">Feta(+220FT)</label><br>
                        <img src="images/feta.png" alt="feta">
                    </span>
                    <div class="bottom">
                        <input class="sum" data-ar="220" type="checkbox" name="feta">
                    </div>
                </div>
            </div>

            <!--   Szószok     -->
            <h3 class="category-text"><i class="fad fa-pepper-hot p-2"></i>Szószok (+150FT)</h3>

            <div class="feltet">
                <div class="item" onclick="check('ketchup')">
                    <span>
                        <label for="ketchup">Ketchup</label><br>
                        <img src="images/ketchup.png" alt="Ketchup">
                    </span>
                    <div class="bottom">
                        <input class="sum" data-ar="150" type="checkbox" name="ketchup">
                    </div>
                </div>

                <div class="item" onclick="check('majonez')">
                    <span>
                        <label for="majonez">Majonéz</label><br>
                        <img src="images/mayo.png" alt="Majonéz">
                    </span>
                    <div class="bottom">
                        <input class="sum" data-ar="150" type="checkbox" name="majonez">
                    </div>
                </div>

                <div class="item" onclick="check('BBQ')">
                    <span>
                        <label for="BBQ">BBQ</label><br>
                        <img src="images/bbq.png" alt="BBQ">
                    </span>
                    <div class="bottom">
                        <input class="sum" data-ar="150" type="checkbox" name="BBQ">
                    </div>
                </div>


                <div class="item" onclick="check('chilis')">
                    <span>
                        <label for="chilis">Chilis</label><br>
                        <img src="images/chili.png" alt="Chili">
                    </span>
                    <div class="bottom">
                        <input class="sum" data-ar="150" type="checkbox" name="chilis">
                    </div>
                </div>

                <div class="item" onclick="check('mustar')">
                    <span>
                        <label for="mustar">Mustár</label><br>
                        <img src="images/mustard.png" alt="Mustár">
                    </span>
                    <div class="bottom">
                        <input class="sum" data-ar="150" type="checkbox" name="mustar">
                    </div>
                </div>

            </div>
            <!--   Köret     -->
            <h3 class="category-text"><i class="fas fa-french-fries p-2"></i>Köret</h3>

            <div class="feltet">

                <div class="item" onclick="check('hasab')">
                    <span>
                        <label for="hasab">Hasáb(+300FT)</label>
                        <img src="images/fries.png" alt="Hasáb">
                    </span>
                    <div class="bottom">
                        <input class="sum" data-ar="300" type="checkbox" name="hasab">
                    </div>
                </div>

                <div class="item" onclick="check('hagymakarika')">
                    <span>
                        <label for="hagymakarika">Hagymakarika (+250Ft)</label>
                        <img src="images/onionrings.png" alt="Hagymakarika">
                    </span>
                    <div class="bottom">
                        <input class="sum" data-ar="250" type="checkbox" name="hagymakarika">
                    </div>
                </div>

                <div class="item" onclick="check('kaviar')">
                    <span>
                        <label for="Kaviár">Kaviár(+1200FT)</label>
                        <img src="images/caviar.png" alt="Kaviár">
                    </span>
                    <div class="bottom">
                        <input class="sum" data-ar="1200" type="checkbox" name="kaviar">
                    </div>
                </div>

                <!--   Elküldés / Törlés Gombok      -->

                <div class="buttons">
                    <input type="submit" name="submit" value="Elkészít">
                    <input type="reset" onclick="torles()" value="Törlés">
                </div>
            </div>
        </form>


        <!-- 
        ##
        ##       Mások hamburgerei
        ##     
        -->


        <h3 class="category-text"><i class="fas fa-hamburger pr-2"></i>Mások hamburgerei</h3>

        <div id="masok-hamburger">
            <h6 class="m-3">Rendezés
                <select id="rendezes" name="rendezes">
                    <option value="alap">Alapértelmezett</option>
                    <option value="kedvenc">Kedvenceim </option>
                    <option value="arnov">Ár szerint növekvő</option>
                    <option value="arcsok">Ár szerint csökkenő</option>
                    <option value="nevnov">Név szerint növekvő</option>
                    <option value="nevcsok">Név szerint csökkenő</option>
                </select>
            </h6>
            <table class="table table-dark table-striped">
                <thead>
                    <tr>
                        <th scope="col">Szerkesztés</th>
                        <th scope="col">Név</th>
                        <th scope="col">Sajt</th>
                        <th scope="col">Bacon</th>
                        <th scope="col">Húspogácsa</th>
                        <th scope="col">Feltétek</th>
                        <th scope="col">Ár(Ft)</th>
                    </tr>
                </thead>

                <tbody id="results">
                    <?php
                    include('others.php');
                    ?>
                </tbody>
            </table>
        </div>



        <!-- 
        ##
        ##       Comment
        ##     
    -->

        <h3 class="category-text"> <i class="fad fa-comments-alt p-2"></i>Hozzászólások</h3>
        <div class="comments">
            <div class="body">


                <?php
                include('commentek.php');
                ?>

            </div>
            <div class="chat">
                <form method="GET" action="chat.php">
                    <!-- 
                ##
                ##       Hiba kiirás
                ##     
                -->
                    <?php
                    if (isset($_GET['hibaFelNev'])) {
                        $hibaFelNev = $_GET['hibaFelNev'];
                        echo "<h1 class='hiba'>$hibaFelNev</h1>";
                    }


                    ?>
                    <label for="felhasznalonev">Név:</label>
                    <input type="text" name="felhasznalonev" id="felhasznalonev">
                    <label for="msg">Üzenet:</label>
                    <textarea name="msg" id="msg"></textarea>
                    <input type="submit" name="submitchat" value="Küldés">
                </form>
            </div>
        </div>
    </main>


    <!-- Footer -->
    <footer class="page-footer font-small blue">

        <!-- Copyright -->
        <div class="footer-copyright text-center py-3">© 2020 Copyright:
            <p>Horváth Roland</p>
        </div>
        <!-- Copyright -->

    </footer>
    <!-- Footer -->
    <script src="main.js" defer></script>
</body>

</html>