///////////////////////////////////////////////
//
//      Globális változók
//
/////////////////////////////////////////////////

let osszeg = 0;
renderTheme();

///////////////////////////////////////////////
//
//                  Jquery
//
/////////////////////////////////////////////////

$(document).ready(function () {
  kiir();
  ///////////////////////////////////////////////
  //
  //      Az összeg hozzáadása a data-ar szerint
  //
  /////////////////////////////////////////////////

  $(".sum").each(function (index) {
    $(this).on("click", function () {
      if ($(this).prop("checked") == true) {
        osszeg += Number(this.dataset.ar);
      } else {
        osszeg -= Number(this.dataset.ar);
      }

      check($(this).attr("name"));
      kiir();
    });
  });

  ///////////////////////////////////////////////
  //
  //      Ajax
  //     SQL rendezés input:select értéke alapján
  //
  /////////////////////////////////////////////////
  $("#rendezes").change(function () {
    let qString = "sub=" + $(this).val();
    $.post("rendezes.php", qString, valaszKezeles);
  });

  function valaszKezeles(adat) {
    $("#results").html(adat);
    heart();
  }

  ///////////////////////////////////////////////
  //
  //     Kedvenc Function
  //
  //    A szivecske iconokra Event listenert ad
  //    Elküldi a kedvenc.php-ba a táblázat id-jét
  //    Beállítja a szineket
  //
  //    kedvenc: 1 - Igaz (filled / beszinezettt sziv)
  //    kedvenc: 0 - Hamis ( fehér / üres sziv)//
  //
  /////////////////////////////////////////////////

  function heart() {
    $(".heart").on("click", function () {
      if (!$(this).hasClass("filled")) {
        $(this).addClass("filled");
        let tr = $(this).closest("tr").attr("id");
        $.ajax({
          type: "POST",
          url: "kedvenc.php",
          data: { id: tr, kedvenc: 1 },
        });
      } else {
        $(this).removeClass("filled");
        let tr = $(this).closest("tr").attr("id");
        $.ajax({
          type: "POST",
          url: "kedvenc.php",
          data: { id: tr, kedvenc: 0 },
        });
      }
    });
  }
  heart();
}); //  <--------- Jquery Vége ---------->

///////////////////////////////////////////////
//
//      Téma megváltoztatása
//
/////////////////////////////////////////////////

function renderTheme() {
  let theme = localStorage.getItem("theme");

  const body = document.body;
  const maintext = document.getElementById("main-text");
  const footer = document.getElementsByTagName("footer");

  if (theme === null) {
    //Alapból Light theme-re állítjuk
    localStorage.setItem("theme", "light");
  }

  if (theme === "dark") {
    body.classList.add("dark-theme");
    maintext.classList.add("dark-theme");
    footer[0].classList.add("dark-theme");
  } else if (theme === "light") {
    body.classList.remove("dark-theme");
    maintext.classList.remove("dark-theme");
    footer[0].classList.remove("dark-theme");
  }
}

/**
 *
 *  Az ellentétjére változtatja a Theme-t majd le rendereli.
 *
 */
function toggleTheme() {
  let theme = localStorage.getItem("theme");
  if (theme === "dark") {
    localStorage.setItem("theme", "light");
  } else {
    localStorage.setItem("theme", "dark");
  }
  renderTheme();
}

/**
 *
 * Megjeleníti az összegjelzőt és kiírja az összeget amennyiben az nagyobb mint 0
 *
 */
function kiir() {
  if (osszeg !== 0) {
    document.getElementsByClassName("osszegjelzo")[0].style.display = "inline";
    document.getElementById("osszegtext").innerHTML = osszeg;
    document.getElementsByClassName("osszeg")[0].value = Number(osszeg);
  } else {
    document.getElementsByClassName("osszegjelzo")[0].style.display = "none";
  }
}

/**
 *
 *
 *  A nevet beteszi a textarea-ba, mintha neki lenne címezve
 *
 *
 * @param nev {String} - Felhasználó neve
 */
function reply(nev) {
  document.querySelector("#msg").value = "@" + nev + " ";
}

/**
 *
 *
 *  A checkbox data-ar attributum alapján kiszámolja az összeget,
 *  megváltoztatja a container színét amelyben benne van.
 *
 * @param name {String} - Checkbox name attributuma
 */
function check(name) {
  /*
    mezo - checkbox tartálya (.item)
    checkertek - checkbox értéke (true vagy false)
  */
  let mezo = document.getElementsByName(name)[0].parentElement.parentElement;
  let alsocsik = document.getElementsByName(name)[0].parentElement;
  let checkertek = document.getElementsByName(name)[0].checked;

  document.getElementsByName(name)[0].checked = !checkertek;
  if (!checkertek === true) {
    osszeg += Number(document.getElementsByName(name)[0].dataset.ar);
    mezo.style.backgroundColor = "#f0a500";
    alsocsik.style.backgroundColor = "white";
  } else {
    osszeg -= Number(document.getElementsByName(name)[0].dataset.ar);
    mezo.style.backgroundColor = "white";
    alsocsik.style.backgroundColor = "#f0a500";
  }

  kiir();
}

/**
 *
 * Törtli az összeget, és kiirja az új értéket
 *
 */
function torles() {
  let feltetMezok = document.querySelectorAll(".sum");

  feltetMezok.forEach((mezo) => {
    if (mezo.checked) {
      check(mezo.name);
    } else {
      return;
    }
  });

  osszeg = 0;
  kiir();
}

/**
 *
 *
 *  Generál egy random nevet és ki is írja inputba
 *
 * @param id {String} - Input ID-je
 */
function nevGeneralas(id) {
  let fname =
    "Mega,Omega,Giga,Szaftos,Nagy,Halálos,Fantasztikus,Erős,ízletes,Szép,Szelíd,Durva,Hangos,Kegyetlen,Harcos,Magas,Titkos,Okos,Piros,Tüzes,Félénk,Morcos,Hiperaktív,Pörgős,Táncos,Ütős";
  let lname =
    "Burger,Csoda,Szendvics,Hambi,Eleség,Élelem,Marás,Piton,Hős,Királyné,Herceg,Sárkány,Buci,Hegyomlás,Szaft,Hústorony,Gombóc,Bomba,Társ";
  let str = "";

  fname = fname.split(",");
  lname = lname.split(",");

  let nr1 = Math.floor(Math.random() * fname.length);
  let nr2 = Math.floor(Math.random() * lname.length);

  str = fname[nr1] + " " + lname[nr2];
  document.getElementById(id).value = str;
}

/**
 *
 *
 *  A form mezőit feltölti a megadott paraméterek alapján
 *
 *
 *
 * @param nev {String} - hamburger neve
 * @param sajt {String} - sajt száma
 * @param bacon {String} - bacon száma
 * @param hus {String} - húspogácsa száma
 * @param feltetek {String} - Feltétek ";"-al elválasztva
 * @param ar {String} - Ár
 */
function edit(nev, sajt, bacon, hus, feltetek, ar) {
  torles();
  let burgerNevMezo = document.getElementById("burgernev");
  let sajtMezo = document.getElementById("dbSajt");
  let baconMezo = document.getElementById("dbBacon");
  let husMezo = document.getElementById("dbHus");
  let feltetMezok = document.querySelectorAll(".sum");

  burgerNevMezo.value = nev;
  sajtMezo.value = Number(sajt);
  baconMezo.value = Number(bacon);
  husMezo.value = Number(hus);
  feltetek = feltetek.split(";");

  for (let i = 0; i < feltetMezok.length; i++) {
    for (let j = 0; j < feltetek.length; j++) {
      if (feltetMezok[i].name === feltetek[j]) {
        //Egyezés
        check(feltetMezok[i].name);
      }
    }
  }

  osszeg = Number(ar);
  kiir();
  //Felugrás a képernyő tetejére
  window.scrollTo(0, 419);
}

/**
 *
 *
 *  A gomb a megadott id-vel rendelkező inputot növeli 1-el,
 *  frissíti az összeget
 *
 * @param target {String} - input neve (id)
 */
function dbNovel(target) {
  let input = document.getElementById(target);
  let db = Number(input.value);
  if (db >= 3) {
    return;
  } else {
    db++;
    input.value = db;
    osszeg += Number(input.dataset.ar);
    kiir();
  }
}
/**
 *
 *
 *  A gomb a megadott id-vel rendelkező inputot csökkenti 1-el,
 *  frissíti az összeget
 *
 * @param target {String} - input neve (id)
 */
function dbCsokkent(target) {
  //Input value csökkentése
  let input = document.getElementById(target);
  let db = Number(input.value);
  if (db <= 0) {
    return;
  } else {
    db--;
    input.value = db;
    osszeg -= Number(input.dataset.ar);
    kiir();
  }
}
