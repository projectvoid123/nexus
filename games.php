<?php
$page = "Games";
define('allowed', true);
include 'header.php';
?>

    <main>
        <div id="pinnedGamesSection"></div>
        <div class="games-header">
            <div class="title-section">
                <h1 class="section-title">Games Library</h1>
                <p class="pin-instruction">(Right click any game to pin the game at the top of the page)</p>
            </div>
            <div class="search-bar">
                <input type="text" id="searchInput" placeholder="Search games...">
                <button class="random-game-btn" onclick="playRandomGame()">Random Game</button>
            </div>
        </div>
        <div class="games-grid" id="gamesGrid">
        </div>
        <div class="pages-title">Pages</div>
        <div class="pagination">
            <button>←</button>
            <button class="active">1</button>
            <button>2</button>
            <button>3</button>
            <button>→</button>
        </div>
    </main>

    <script>
    let GAMES_PER_PAGE = 50;

    const games = [
        {
            title: "1v1.lol",
            path: "games/1v1lol64397191/index.html",
            thumbnail: "games/1v1lol64397191/splash.png"
        },
        {
            title: "Amazing Rope Police",
            path: "games/amazing-rope-police93013130/index.html",
            thumbnail: "games/amazing-rope-police93013130/splash.jpeg"
        },
        {
            title: "Slope",
            path: "games/slope27916955/index.html",
            thumbnail: "games/slope27916955/slope4.jpeg"
        },
        {
            title: "Slope 2",
            path: "games/slope238061070/index.html",
            thumbnail: "games/slope238061070/slope-2-logo.png"
        },
        {
            title: "Slope 3",
            path: "games/slope379796534/index.html",
            thumbnail: "games/slope379796534/cover.png"
        },
        {
            title: "Snow Rider 3D",
            path: "games/snowrider3d22046570/index.html",
            thumbnail: "games/snowrider3d22046570/icon.png"
        },
        {
            title: "Retro Bowl",
            path: "games/retro-bowl76669349/index.html",
            thumbnail: "games/retro-bowl76669349/icon.png"
        },
        {
            title: "Little Alchemy 2",
            path: "games/littlealchemy211568088/index.html",
            thumbnail: "games/littlealchemy211568088/logo.png"
        },
        {
            title: "Drift Hunters",
            path: "games/drifthunters18852033/index.html",
            thumbnail: "games/drifthunters18852033/icon.png"
        },
        {
            title: "Burrito Bison",
            path: "games/burritobison50643756/index.html",
            thumbnail: "games/burritobison50643756/logo.png"
        },
        {
            title: "Run 3 Editor",
            path: "games/editor76874655/index.html",
            thumbnail: "games/editor76874655/cover.png"
        },
        {
            title: "Run 3",
            path: "games/run360908641/index.html",
            thumbnail: "games/run360908641/icon.jpeg"
        },
        {
            title: "Run 2",
            path: "games/run270227175/index.html",
            thumbnail: "games/run270227175/icon.jpg"
        },
        {
            title: "Run",
            path: "games/run50365546/index.html",
            thumbnail: "games/run50365546/icon.jpeg"
        },
        {
            title: "Eggy Car",
            path: "games/eggycar26237997/index.html",
            thumbnail: "games/eggycar26237997/logo.png"
        },
        {
            title: "Drift Boss",
            path: "games/drift-boss78424020/index.html",
            thumbnail: "games/drift-boss78424020/icon.png"
        },
        {
            title: "Drive Mad",
            path: "games/drivemad69748541/index.html",
            thumbnail: "games/drivemad69748541/icon.png"
        },
        {
            title: "MotoX3M",
            path: "games/motox3m41241561/index.html",
            thumbnail: "games/motox3m41241561/icon.png"
        },
        {
            title: "MotoX3M Pool",
            path: "games/motox3m-pool512512512/index.html",
            thumbnail: "games/motox3m-pool512512512/splash.jpg"
        },
        {
            title: "MotoX3M Spooky",
            path: "games/motox3m-spooky51251289180/index.html",
            thumbnail: "games/motox3m-spooky51251289180/splash.jpeg"
        },
        {
            title: "MotoX3M Winter",
            path: "games/motox3m-winter51412978/index.html",
            thumbnail: "games/motox3m-winter51412978/download.jpeg"
        },
        {
            title: "2048",
            path: "games/204821589195/index.html",
            thumbnail: "games/204821589195/icon.png"
        },
        {
            title: "Idle Dice",
            path: "games/idle-dice64519227/index.html",
            thumbnail: "games/idle-dice64519227/icon.png"
        },
        {
            title: "Avalanche",
            path: "games/avalanche81687557/index.html",
            thumbnail: "games/avalanche81687557/icon.png"
        },
        {
            title: "Poly Track",
            path: "games/polytrack21544571/index.html",
            thumbnail: "games/polytrack21544571/logo.png"
        },
        {
            title: "Cookie Clicker",
            path: "games/cookieclicker90875478/index.html",
            thumbnail: "games/cookieclicker90875478/logo.png"
        },
        {
            title: "Basketball Stars",
            path: "games/basketball-stars24403381/index.html",
            thumbnail: "games/basketball-stars24403381/icon.png"
        },
        {
            title: "Idle Breakout",
            path: "games/idlebreakout67038869/index.html",
            thumbnail: "games/idlebreakout67038869/image.png"
        },
        {
            title: "Learn To Fly",
            path: "games/learntofly18343468/index.html",
            thumbnail: "games/learntofly18343468/icon.png"
        },
        {
            title: "Learn To Fly 2",
            path: "games/learntofly294926221/index.html",
            thumbnail: "games/learntofly294926221/logo.jpg"
        },
        {
            title: "Learn To Fly Idle",
            path: "games/learntoflyidle81156833/index.html",
            thumbnail: "games/learntoflyidle81156833/icon.jpg"
        },
        {
            title: "Roof Top Snipers",
            path: "games/rooftopsnipers49055705/index.html",
            thumbnail: "games/rooftopsnipers49055705/logo.png"
        },
        {
            title: "Roof Top Snipers 2",
            path: "games/rooftopsnipers250219076/index.html",
            thumbnail: "games/rooftopsnipers250219076/icon.png"
        },
        {
            title: "OvO",
            path: "games/ovo25871273/index.html",
            thumbnail: "games/ovo25871273/ovo.png"
        },
        {
            title: "Monkey Mart",
            path: "games/monkeymart17198718/index.html",
            thumbnail: "games/monkeymart17198718/unnamed.png"
        },
        {
            title: "Rise Higher",
            path: "games/risehigher84795058/index.html",
            thumbnail: "games/risehigher84795058/icon.png"
        },
        {
            title: "Death Run 3D",
            path: "games/death-run-3d22480020/index.html",
            thumbnail: "games/death-run-3d22480020/logo.png"
        },
        {
            title: "Ahievement Unlocked",
            path: "games/achieveunlocked65430317/index.html",
            thumbnail: "games/achieveunlocked65430317/icon.png"
        },
        {
            title: "Ahievement Unlocked 2",
            path: "games/achieveunlocked294693836/index.html",
            thumbnail: "games/achieveunlocked294693836/icon.png"
        },
        {
            title: "Gun Spin",
            path: "games/gunspin23084898/index.html",
            thumbnail: "games/gunspin23084898/icon.png"
        },
        {
            title: "House of Hazards",
            path: "games/house-of-hazards69439159/index.html",
            thumbnail: "games/house-of-hazards69439159/icon.png"
        },














        {
            title: "Basket Random",
            path: "games/basketrandom71333921/index.html",
            thumbnail: "games/basketrandom71333921/test.png"
        },
        {
            title: "Soccer Random",
            path: "games/soccerrandom18072288/index.html",
            thumbnail: "games/soccerrandom18072288/test.png"
        },
        {
            title: "Volley Random",
            path: "games/volleyrandom10052064/index.html",
            thumbnail: "games/volleyrandom10052064/icon.png"
        },
        {
            title: "Boxing Random",
            path: "games/boxing-random67909477/index.html",
            thumbnail: "games/boxing-random67909477/logo.png"
        },
        {
            title: "Cube Field",
            path: "games/cubefield83721024/index.html",
            thumbnail: "games/cubefield83721024/logo.png"
        },
        {
            title: "CSGO Clicker",
            path: "games/csgoclicker30814172/index.html",
            thumbnail: "games/csgoclicker30814172/logo.png"
        },
        {
            title: "Cut The Rope",
            path: "games/cuttherope58283027/index.html",
            thumbnail: "games/cuttherope58283027/icon.png"
        },
        {
            title: "Cut The Rope Holiday",
            path: "games/cuttherope-holiday32841380/index.html",
            thumbnail: "games/cuttherope-holiday32841380/icon.png"
        },
        {
            title: "Tiny Fishing",
            path: "games/tinyfishing16069117/index.html",
            thumbnail: "games/tinyfishing16069117/thumb.png"
        },        
        {
            title: "Bit Life",
            path: "games/bitlife63489839/index.html",
            thumbnail: "games/bitlife63489839/logo.png"
        },
        {
            title: "Duck Life 1",
            path: "games/ducklife149085729/index.html",
            thumbnail: "games/ducklife149085729/ducklife1.png"
        },
        {
            title: "Duck Life 2",
            path: "games/ducklife297204407/index.html",
            thumbnail: "games/ducklife297204407/ducklife2.png"
        },
        {
            title: "Duck Life 3",
            path: "games/ducklife353908549/index.html",
            thumbnail: "games/ducklife353908549/ducklife3.png"
        },
        {
            title: "Duck Life 4",
            path: "games/ducklife448120106/index.html",
            thumbnail: "games/ducklife448120106/icon.png"
        },
        {
            title: "Duck Life 5",
            path: "games/ducklife515638689/index.html",
            thumbnail: "games/ducklife515638689/ducklife5.png"
        },
        {
            title: "Crossy Road Space",
            path: "games/crossyroadspace43762430/index.html",
            thumbnail: "games/crossyroadspace43762430/crossyroad.png"
        },
        {
            title: "Flappy Bird",
            path: "games/flappybird78026185/index.html",
            thumbnail: "games/flappybird78026185/icon.png"
        },
        {
            title: "FNAF 1",
            path: "games/fnaf188441277/index.html",
            thumbnail: "games/fnaf188441277/splash.jpg"
        },
        {
            title: "FNAF 2",
            path: "games/fnaf235497283/index.html",
            thumbnail: "games/fnaf188441277/splash.jpg"
        },
        {
            title: "FNAF 3",
            path: "games/fnaf337638014/index.html",
            thumbnail: "games/fnaf188441277/splash.jpg"
        },
        {
            title: "FNAF 4",
            path: "games/fnaf481508987/index.html",
            thumbnail: "games/fnaf188441277/splash.jpg"
        },
        {
            title: "Vex 1",
            path: "games/vex174828198/index.html",
            thumbnail: "games/vex174828198/icon.png"
        },
        {
            title: "Vex 2",
            path: "games/vex250366795/index.html",
            thumbnail: "games/vex250366795/icon.png"
        },
        {
            title: "Vex 3",
            path: "games/vex313982252/index.html",
            thumbnail: "games/vex313982252/icon.png"
        },
        {
            title: "Vex 4",
            path: "games/vex464841685/index.html",
            thumbnail: "games/vex464841685/vex4.png"
        },
        {
            title: "Vex 5",
            path: "games/vex591860601/index.html",
            thumbnail: "games/vex591860601/icon.png"
        },
        {
            title: "Vex 6",
            path: "games/vex681795946/index.html",
            thumbnail: "games/vex681795946/icon.png"
        },
        {
            title: "Vex 7",
            path: "games/vex754736201/index.html",
            thumbnail: "games/vex754736201/icon.jpeg"
        },
        {
            title: "Among Us",
            path: "games/amongus46360672/index.html",
            thumbnail: "games/amongus46360672/logo.png"
        },
        {
            title: "Jetpack Joyride",
            path: "games/jetpackjoyride64735331/index.html",
            thumbnail: "games/jetpackjoyride64735331/logo.jpeg"
        },
        {
            title: "Hole.io",
            path: "games/holeio42254981/index.html",
            thumbnail: "games/holeio42254981/icon.png"
        },
        {
            title: "2D Rocket League",
            path: "games/2drocketleague98836830/index.html",
            thumbnail: "games/2drocketleague98836830/unnamed.png"
        },
        {
            title: "Bad Ice Cream",
            path: "games/badicecream53252635/index.html",
            thumbnail: "games/badicecream53252635/bad-ice-cream.png"
        },
        {
            title: "Bad Ice Cream 2",
            path: "games/badicecream221403455/index.html",
            thumbnail: "games/badicecream221403455/bad-ice-cream-2.png"
        },
        {
            title: "Bad Ice Cream 3",
            path: "games/badicecream385074069/index.html",
            thumbnail: "games/badicecream385074069/bad-ice-cream-3.png"
        },
        {
            title: "Bad Times Simulator",
            path: "games/badtimesimulator82065673/index.html",
            thumbnail: "games/badtimesimulator82065673/icon.png"
        },
        {
            title: "Happy Wheels",
            path: "games/happywheels36793880/index.html",
            thumbnail: "games/happywheels36793880/Untitled.jpeg"
        },
        {
            title: "Red Ball 3",
            path: "games/redball336387681/index.html",
            thumbnail: "games/redball336387681/redball3.png"
        },
        {
            title: "Red Ball 4",
            path: "games/redball430551636/index.html",
            thumbnail: "games/redball430551636/redball4.webp"
        },
        {
            title: "Super Hot",
            path: "games/superhot64243822/index.html",
            thumbnail: "games/superhot64243822/icon.png"
        },














        {
            title: "Tetris",
            path: "games/tetris51642576/index.html",
            thumbnail: "games/tetris51642576/logo.png"
        },
        {
            title: "Tetris Sand",
            path: "games/tetris-sand10054560/index.html",
            thumbnail: "games/tetris-sand10054560/logo.png"
        },
        {
            title: "Temple Run 2",
            path: "games/templerun225196359/index.html",
            thumbnail: "games/templerun225196359/img/cover.png"
        },
        {
            title: "TABS",
            path: "games/tabs47770878/index.html",
            thumbnail: "games/tabs47770878/unnamed.png"
        },
        {
            title: "The Impossible Game",
            path: "games/theimpossiblegame23720739/index.html",
            thumbnail: "games/theimpossiblegame23720739/image.jpg"
        },
        {
            title: "The Impossible Quiz",
            path: "games/theimpossiblequiz66262571/index.html",
            thumbnail: "games/theimpossiblequiz66262571/tiq.avif"
        },
        {
            title: "Solitaire",
            path: "games/solitaire10873657/index.html",
            thumbnail: "games/solitaire10873657/cover.svg"
        },
        {
            title: "Stickman Hook",
            path: "games/stickman-hook35925842/index.html",
            thumbnail: "games/stickman-hook35925842/icon.jpg"
        },
        {
            title: "Worlds Hardest Game 1",
            path: "games/worldshardestgame10208178/index.html",
            thumbnail: "games/worldshardestgame10208178/icon.png"
        },
        {
            title: "Worlds Hardest Game 2",
            path: "games/worldhardestgame2238822403/index.html",
            thumbnail: "games/worldhardestgame2238822403/icon.jpg"
        },
        {
            title: "Wordle",
            path: "games/wordle14230843/index.html",
            thumbnail: "games/wordle14230843/icon.png"
        },
        {
            title: "Subway Surfers NY",
            path: "games/subway-surfers-ny18048172/index.html",
            thumbnail: "games/subway-surfers-ny18048172/NewYorkIcon.png"
        },

        {
            title: "Time Shooter 1",
            path: "games/timeshooter199272495/index.html",
            thumbnail: "games/timeshooter199272495/logo.png"
        },
        {
            title: "Time Shooter 2",
            path: "games/timeshooter267763198/index.html",
            thumbnail: "games/timeshooter267763198/logo.jpg"
        },
        {
            title: "Time Shooter 3",
            path: "games/timeshooter318840314/index.html",
            thumbnail: "games/timeshooter318840314/logo.png"
        },
        {
            title: "Papas Burgeria",
            path: "games/papasburgeria62439294/index.html",
            thumbnail: "games/papasburgeria62439294/icon.png"
        },
        {
            title: "Papas Freezeria",
            path: "games/papasfreezeria79511720/index.html",
            thumbnail: "games/papasfreezeria79511720/image.png"
        },
        {
            title: "Papas Cupcakeria",
            path: "games/papas-cupcakeria43133386/index.html",
            thumbnail: "games/papas-cupcakeria43133386/icon.png"
        },
        {
            title: "Papas Wingeria",
            path: "games/papaswingeria17488398/index.html",
            thumbnail: "games/papaswingeria17488398/papaswingeria.png"
        },
        {
            title: "Papas Tacomia",
            path: "games/papastacomia96557017/index.html",
            thumbnail: "games/papastacomia96557017/papastacomia.png"
        },
        {
            title: "Papas Sushiria",
            path: "games/papassushiria60448775/index.html",
            thumbnail: "games/papassushiria60448775/papassushiria.png"
        },
        {
            title: "Papas Scooperia",
            path: "games/papasscooperia70779959/index.html",
            thumbnail: "games/papasscooperia70779959/papasscooperia.png"
        },
        {
            title: "Papas Pizzeria",
            path: "games/papaspizzeria29642629/index.html",
            thumbnail: "games/papaspizzeria29642629/images.jpeg"
        },
        {
            title: "Papas Pastaria",
            path: "games/papaspastaria18005741/index.html",
            thumbnail: "games/papaspastaria18005741/papaspastaria.png"
        },
        {
            title: "Papas Pancakeria",
            path: "games/papaspancakeria91764127/index.html",
            thumbnail: "games/papaspancakeria91764127/papaspancakeria.png"
        },
        {
            title: "Papas Donuteria",
            path: "games/papasdonuteria94559846/index.html",
            thumbnail: "games/papasdonuteria94559846/papasdonuteria.png"
        },
        {
            title: "Papas Cheeseria",
            path: "games/papascheeseria84209235/index.html",
            thumbnail: "games/papascheeseria84209235/papascheeseria.png"
        },
        {
            title: "Papas Bakeria",
            path: "games/papasbakeria22587920/index.html",
            thumbnail: "games/papasbakeria22587920/papasbakeria.png"
        },
        {
            title: "BTD 1",
            path: "games/btd49386580/index.html",
            thumbnail: "games/btd49386580/logo.webp"
        },
        {
            title: "BTD 2",
            path: "games/btd211833799/index.html",
            thumbnail: "games/btd211833799/logo.webp"
        },
        {
            title: "BTD 3",
            path: "games/btd345370411/index.html",
            thumbnail: "games/btd345370411/icon.png"
        },
        {
            title: "BTD 4",
            path: "games/btd493796346/index.html",
            thumbnail: "games/btd493796346/logo.jpg"
        },
        {
            title: "BTD 5",
            path: "games/btd559947922/index.html",
            thumbnail: "games/btd559947922/wogo.png"
        },
        {
            title: "BTD 6",
            path: "games/btd637640871/index.html",
            thumbnail: "games/btd637640871/uwu.png"
        },
        {
            title: "Circloo",
            path: "games/circloo18430665/index.html",
            thumbnail: "games/circloo18430665/icon.png"
        },
        {
            title: "Cluster Rush",
            path: "games/cluster-rush59720049/index.html",
            thumbnail: "games/cluster-rush59720049/splash.png"
        },
        {
            title: "Friday Night Funkin",
            path: "games/fridaynightfunkin99993125/index.html",
            thumbnail: "games/fridaynightfunkin99993125/fnf-icon.jpg"
        },
        {
            title: "Fruit Ninja",
            path: "games/fruitninja41917612/index.html",
            thumbnail: "games/fruitninja41917612/FruitNinjaTeaser.jpg"
        },
        {
            title: "Osu",
            path: "games/osu23476868/index.html",
            thumbnail: "games/osu23476868/icon.png"
        },
        {
            title: "Pizza Tower",
            path: "games/pizzatower34256583/index.html",
            thumbnail: "games/pizzatower34256583/logo.png"
        },















        {
            title: "Pacman",
            path: "games/pacman88611885/index.html",
            thumbnail: "games/pacman88611885/icon.png"
        },
        {
            title: "Paper.io 2",
            path: "games/paperio264619756/index.html",
            thumbnail: "games/paperio264619756/logo.png"
        },
        {
            title: "Sand Game",
            path: "games/sandgame97583583/index.html",
            thumbnail: "games/sandgame97583583/icon.png"
        },
        {
            title: "Skibidi Toilet",
            path: "games/skibiditoilet41358020/index.html",
            thumbnail: "games/skibiditoilet41358020/logo.png"
        },
        {
            title: "Skibidi Toilet Attack",
            path: "games/skibiditoiletattack19296523/index.html",
            thumbnail: "games/skibiditoiletattack19296523/logo.png"
        },
        {
            title: "Riddle School 1",
            path: "games/riddleschool34685267/index.html",
            thumbnail: "games/riddleschool34685267/RiddleSchool2.png"
        },
        {
            title: "Riddle School 2",
            path: "games/riddleschool241119488/index.html",
            thumbnail: "games/riddleschool241119488/icon.png"
        },
        {
            title: "Riddle School 3",
            path: "games/riddleschool339764918/index.html",
            thumbnail: "games/riddleschool339764918/riddle-school-3.webp"
        },
        {
            title: "Riddle School 4",
            path: "games/riddleschool450026907/index.html",
            thumbnail: "games/riddleschool450026907/Untitled.jpeg"
        },
        {
            title: "Riddle School 5",
            path: "games/riddleschool558231297/index.html",
            thumbnail: "games/riddleschool558231297/Untitled.jpeg"
        },
        {
            title: "Helix Jump",
            path: "games/helixjump66825148/index.html",
            thumbnail: "games/helixjump66825148/gameIcon.png"
        },
        {
            title: "Block Blast Puzzle",
            path: "games/block-blast-puzzle21629437/index.html",
            thumbnail: "games/block-blast-puzzle21629437/logo.png"
        },
        {
            title: "Doge Miner",
            path: "games/doge-miner55041067/index.html",
            thumbnail: "games/doge-miner55041067/logo.png"
        },
        {
            title: "Draw The Hill",
            path: "games/draw-the-hill58982275/index.html",
            thumbnail: "games/draw-the-hill58982275/icon.png"
        },
        {
            title: "Stack",
            path: "games/stack60108548/index.html",
            thumbnail: "games/stack60108548/logo.png"
        },
        {
            title: "Getaway Shootout",
            path: "games/getaway-shootout82031376/index.html",
            thumbnail: "games/getaway-shootout82031376/icon.png"
        },
        {
            title: "Gun Mayhem",
            path: "games/gun-mayhem86345835/index.html",
            thumbnail: "games/gun-mayhem86345835/icon.png"
        },
        {
            title: "Pandemic 2",
            path: "games/pandemic266427052/index.html",
            thumbnail: "games/pandemic266427052/icon.png"
        },
        {
            title: "Stack Bump 3D",
            path: "games/stackbump14022307/index.html",
            thumbnail: "games/stackbump14022307/thumbnail.jpg"
        },
        {
            title: "Stickman Golf",
            path: "games/stickman-golf80381342/index.html",
            thumbnail: "games/stickman-golf80381342/splash.png"
        },
        {
            title: "A Dance of Fire & Ice",
            path: "games/a-dance-of-fire-and-ice41611571/index.html",
            thumbnail: "games/a-dance-of-fire-and-ice41611571/logo.png"
        },
        {
            title: "Merge Round Racers",
            path: "games/merge-round-racers61077712/index.html",
            thumbnail: "games/merge-round-racers61077712/logo.png"
        },
        {
            title: "Bloxorz",
            path: "games/bloxorz52165411/index.html",
            thumbnail: "games/bloxorz52165411/logo.jpg"
        },
        {
            title: "Backrooms",
            path: "games/backrooms52394872/index.html",
            thumbnail: "games/backrooms52394872/logo.png"
        },
        {
            title: "Glass City",
            path: "games/glass-city32658337/index.html",
            thumbnail: "games/glass-city32658337/logo.png"
        },
        {
            title: "Aqua Park",
            path: "games/aquapark55683457/index.html",
            thumbnail: "games/aquapark55683457/splash.png"
        },
        {
            title: "Big Red Button",
            path: "games/bigredbutton18514259/index.html",
            thumbnail: "games/bigredbutton18514259/bigredbutton.png"
        },
        {
            title: "Town Scaper",
            path: "games/townscaper60507911/index.html",
            thumbnail: "games/townscaper60507911/logo.png"
        },
        {
            title: "Cell Machine",
            path: "games/cell-machine93015988/index.html",
            thumbnail: "games/cell-machine93015988/img/icon.png"
        },
        {
            title: "Break Lock",
            path: "games/breaklock40113014/index.html",
            thumbnail: "games/breaklock40113014/logo.png"
        },
        {
            title: "3 Lines",
            path: "games/3line95088036/index.html",
            thumbnail: "games/3line95088036/cover.png"
        },
        {
            title: "13 Days In Hell",
            path: "games/1365723744/index.html",
            thumbnail: "games/1365723744/cover.png"
        },
        {
            title: "10 Minutes Till Dawn",
            path: "games/10minutestilldawn12551342/index.html",
            thumbnail: "games/10minutestilldawn12551342/splash.png"
        },
        {
            title: "60s Burger Run",
            path: "games/60sburgerrun55222508/index.html",
            thumbnail: "games/60sburgerrun55222508/icon.png"
        },
        {
            title: "A Dark Room",
            path: "games/adarkroom73926077/index.html",
            thumbnail: "games/adarkroom73926077/favicon.ico"
        },
        {
            title: "Age of War",
            path: "games/ageofwar41149336/index.html",
            thumbnail: "games/ageofwar41149336/icon.png"
        },
        {
            title: "Age of War 2",
            path: "games/aow258461955/index.html",
            thumbnail: "games/aow258461955/cover.png"
        },
        {
            title: "Awesome Tanks",
            path: "games/awesometanks39831833/index.html",
            thumbnail: "games/awesometanks39831833/cover.png"
        },
        {
            title: "Bad Piggies",
            path: "games/badpiggies70960867/index.html",
            thumbnail: "games/badpiggies70960867/badpiggies.png"
        },
        {
            title: "Baldis Basics",
            path: "games/baldis-basics91692422/index.html",
            thumbnail: "games/baldis-basics91692422/splash.png"
        },












        
        {
            title: "Balloon Run",
            path: "games/bal30451495/index.html",
            thumbnail: "games/bal30451495/cover.png"
        },
        {
            title: "Bit Planes",
            path: "games/bit-planes55695383/index.html",
            thumbnail: "games/bit-planes55695383/bitplanes.png"
        },
        {
            title: "Boxing Physics 2",
            path: "games/boxingphysics289173008/index.html",
            thumbnail: "games/boxingphysics289173008/icon.png"
        },
        {
            title: "Bubble Shooter",
            path: "games/bub36112456/index.html",
            thumbnail: "games/bub36112456/cover.png"
        },
        {
            title: "Clicker Heroes",
            path: "games/clickerheroes34632594/index.html",
            thumbnail: "games/clickerheroes34632594/clicker-heroes.png"
        },
        {
            title: "Deepest Sword",
            path: "games/deepestsword48855150/index.html",
            thumbnail: "games/deepestsword48855150/logo.png"
        },
        {
            title: "Doodle Jump",
            path: "games/doodlejump27954970/index.html",
            thumbnail: "games/doodlejump27954970/icon.png"
        },
        {
            title: "Draw Climber",
            path: "games/drawclimber61419111/index.html",
            thumbnail: "games/drawclimber61419111/logo.png"
        },
        {
            title: "Earn To Die",
            path: "games/ern47770382/index.html",
            thumbnail: "games/ern47770382/cover.png"
        },
        {
            title: "Hill Climb Racing 2",
            path: "games/hillclimbracing239752829/index.html",
            thumbnail: "games/hillclimbracing239752829/cover.png"
        },
        {
            title: "Knife Hit",
            path: "games/knifehit30377583/index.html",
            thumbnail: "games/knifehit30377583/icon.png"
        },
        {
            title: "Last Horizon",
            path: "games/lasthorizon81077431/index.html",
            thumbnail: "games/lasthorizon81077431/icon.jpg"
        },
        {
            title: "Lazy Jump 3D",
            path: "games/lazyjump3d96798895/index.html",
            thumbnail: "games/lazyjump3d96798895/icon.png"
        },
        {
            title: "Madalin Cars",
            path: "games/madalincars15272930/index.html",
            thumbnail: "games/madalincars15272930/icon.png"
        },
        {
            title: "Mindustry",
            path: "games/mind51837225/index.html",
            thumbnail: "games/mind51837225/cover.png"
        },
        {
            title: "Minesweeper",
            path: "games/minesweeper53922520/index.html",
            thumbnail: "games/minesweeper53922520/cover.png"
        },
        {
            title: "Plants VS Zombies",
            path: "games/pvz44837226/index.html",
            thumbnail: "games/pvz44837226/cover.png"
        },
        {
            title: "Rocket bot Royale",
            path: "games/rocket67509745/index.html",
            thumbnail: "games/rocket67509745/cover.png"
        },
        {
            title: "Funny Ball Game",
            path: "games/funnyballgame91960643/index.html",
            thumbnail: "games/funnyballgame91960643/ball.jpg"
        },
        {
            title: "Gun Mayhem 2",
            path: "games/gunmayhem258438050/index.html",
            thumbnail: "games/gunmayhem258438050/icon.png"
        },
        {
            title: "Gun Mayhem Redux",
            path: "games/gunmayhemredux77459707/index.html",
            thumbnail: "games/gunmayhemredux77459707/icon.png"
        },
        {
            title: "Gunfest",
            path: "games/fest73903095/index.html",
            thumbnail: "games/fest73903095/cover.png"
        },
        {
            title: "WEBGL Fluid",
            path: "games/fluidsim77998441/index.html",
            thumbnail: "games/fluidsim77998441/icon.png"
        },
        {
            title: "Iron Snout",
            path: "games/ironsnout87461375/index.html",
            thumbnail: "games/ironsnout87461375/logo.png"
        },





        
        {
            title: "Bob The Robber 4",
            path: "games/bobtherobber/index.html",
            thumbnail: "games/bobtherobber/logo1.png"
        },
        {
            title: "Whack Your Boss",
            path: "games/whackyourboss/index.html",
            thumbnail: "games/whackyourboss/logo1.png"
        },
        {
            title: "Stealing The Diamond",
            path: "games/stealdiamond/index.html",
            thumbnail: "games/stealdiamond/logo1.png"
        },
        {
            title: "Pokemon Firered",
            path: "games/PokemonFirered/index.html",
            thumbnail: "games/PokemonFirered/logo.jpg"
        },
        {
            title: "Burrito Bison Revenge",
            path: "games/BurritoBisonRevenge/index.html",
            thumbnail: "games/burritobison50643756/logo.png"
        },
        {
            title: "Dummy Never Fails",
            path: "games/dummyneverfails/index.html",
            thumbnail: "games/dummyneverfails/cover.png"
        },
        {
            title: "Dummy Never Fails 2",
            path: "games/dummyneverfails2/index.html",
            thumbnail: "games/dummyneverfails2/cover.png"
        },
        {
            title: "Escaping The Prison",
            path: "games/escapingtheprison/index.html",
            thumbnail: "games/escapingtheprison/cover.png"
        },
        {
            title: "Galaga",
            path: "games/galaga/index.html",
            thumbnail: "games/galaga/cover.png"
        },
        {
            title: "Fleeing The Complex",
            path: "games/FleeingTheComplex/index.html",
            thumbnail: "games/FleeingTheComplex/cover.png"
        },
        {
            title: "Gunblood",
            path: "games/gunblood/index.html",
            thumbnail: "games/gunblood/cover.png"
        },
        {
            title: "Fancy Pants 3",
            path: "games/FancyPants3/index.html",
            thumbnail: "games/FancyPants3/cover.jpg"
        },
        {
            title: "Breaking The Bank",
            path: "games/BreakingTheBank/index.html",
            thumbnail: "games/BreakingTheBank/cover.png"
        },
        {
            title: "Ultimate Off Road",
            path: "games/UltimateOffRoad/index.html",
            thumbnail: "games/UltimateOffRoad/cover.png"
        }
    ];

    let filteredGames = [...games].sort((a, b) => {
        return a.title.localeCompare(b.title);
    });
    let currentPage = 1;

    window.pinnedGames = JSON.parse(localStorage.getItem('pinnedGames') || '[]');

    // Call updateDisplay immediately
    updateDisplay();

    function togglePinGame(event, gameTitle) {
        event.preventDefault(); 

        window.pinnedGames = JSON.parse(localStorage.getItem('pinnedGames') || '[]');
        const gameIndex = window.pinnedGames.findIndex(game => game.title === gameTitle);

        if (gameIndex === -1) {

            const gameToPin = games.find(game => game.title === gameTitle);
            if (gameToPin) {
                window.pinnedGames.push(gameToPin);
                showToast('Game pinned!');
            }
        } else {

            window.pinnedGames.splice(gameIndex, 1);
            showToast('Game unpinned!');
        }

        localStorage.setItem('pinnedGames', JSON.stringify(window.pinnedGames));

        updateDisplay();

        return false; 
    }

    function showToast(message) {
        const toast = document.createElement('div');
        toast.className = 'toast';
        toast.textContent = message;
        document.body.appendChild(toast);

        setTimeout(() => {
            toast.classList.add('show');
            setTimeout(() => {
                toast.classList.remove('show');
                setTimeout(() => toast.remove(), 300);
            }, 2000);
        }, 100);
    }

    function debounce(func, wait) {
        let timeout;
        return function executedFunction(...args) {
            const later = () => {
                clearTimeout(timeout);
                func(...args);
            };
            clearTimeout(timeout);
            timeout = setTimeout(later, wait);
        };
    }

    const debouncedSearch = debounce(() => {
        searchGames();
    }, 300);

    document.getElementById('searchInput').addEventListener('input', debouncedSearch);

    function searchGames() {
        const searchInput = document.getElementById('searchInput');
        const searchTerm = searchInput.value.trim().toLowerCase();

        if (!searchTerm) {
            filteredGames = [...games].sort((a, b) => a.title.localeCompare(b.title)); 
        } else {
            filteredGames = games
                .filter(game => game.title.toLowerCase().includes(searchTerm))
                .sort((a, b) => a.title.localeCompare(b.title));
        }

        currentPage = 1;
        updateDisplay();
    }

    function createGameCards(gamesSubset) {
        return gamesSubset.map(game => {
            const title = game.title.replace(/</g, "&lt;").replace(/>/g, "&gt;");
            const path = encodeURIComponent(game.path);
            const thumbnail = game.thumbnail;
            const isPinned = window.pinnedGames.some(pinned => pinned.title === title);

            return `
                <a href="#" 
                   class="game-card ${isPinned ? 'pinned' : ''}" 
                   data-title="${title}"
                   data-game="${path}"
                   onclick="handleGameClick(event, '${title}', '${path}')"
                   oncontextmenu="togglePinGame(event, '${title}')">
                    <div class="game-thumbnail">
                        <img src="${thumbnail}" 
                             alt="${title}"
                             loading="lazy"
                             onerror="this.src='images/placeholder.png'">
                    </div>
                    <div class="game-info">
                        <h3>${title}</h3>
                    </div>
                    ${isPinned ? '<div class="pin-indicator">📌</div>' : ''}
                </a>
            `;
        }).join('');
    }

    async function handleGameClick(event, title, path) {
        event.preventDefault();

        try {
            window.location.href = `display.php?game=${path}&title=${encodeURIComponent(title)}`;
            
            setTimeout(() => {
                window.history.replaceState({}, '', '/display.php');
            }, 100);
        } catch (error) {
            console.error('Error:', error);
            window.location.href = `display.php?game=${path}&title=${encodeURIComponent(title)}`;
        }
    }

    function updateDisplay() {
        // Handle pinned games section
        const pinnedGamesSection = document.getElementById('pinnedGamesSection');
        if (window.pinnedGames.length > 0) {
            pinnedGamesSection.innerHTML = `
                <div class="games-header">
                    <h1 class="section-title">Pinned Games</h1>
                </div>
                <div class="games-grid">${createGameCards(window.pinnedGames)}</div>
            `;
            pinnedGamesSection.style.display = 'block';
        } else {
            pinnedGamesSection.style.display = 'none';
        }

        // Clear existing content first
        const gamesGrid = document.getElementById('gamesGrid');
        gamesGrid.innerHTML = '';

        // Calculate page content
        const startIndex = (currentPage - 1) * GAMES_PER_PAGE;
        const endIndex = startIndex + GAMES_PER_PAGE;
        const gamesSubset = filteredGames.slice(startIndex, endIndex);

        // Add new content after a brief delay to ensure cleanup
        requestAnimationFrame(() => {
            gamesGrid.innerHTML = createGameCards(gamesSubset);
        });

        updatePagination();
    }

    function updatePagination() {
        const totalPages = Math.ceil(filteredGames.length / GAMES_PER_PAGE);
        const pagination = document.querySelector('.pagination');
        const fragment = document.createDocumentFragment();

        // Add prev button
        const prevButton = document.createElement('button');
        prevButton.textContent = '←';
        prevButton.disabled = currentPage === 1;
        prevButton.addEventListener('click', () => changePage('prev'));
        fragment.appendChild(prevButton);

        // Show all pages
        for (let i = 1; i <= totalPages; i++) {
            const pageButton = document.createElement('button');
            pageButton.textContent = i;
            if (currentPage === i) {
                pageButton.classList.add('active');
            }
            pageButton.addEventListener('click', () => changePage(i));
            fragment.appendChild(pageButton);
        }

        // Add next button
        const nextButton = document.createElement('button');
        nextButton.textContent = '→';
        nextButton.disabled = currentPage === totalPages;
        nextButton.addEventListener('click', () => changePage('next'));
        fragment.appendChild(nextButton);

        pagination.innerHTML = '';
        pagination.appendChild(fragment);
    }

    function changePage(page) {
        const totalPages = Math.ceil(filteredGames.length / GAMES_PER_PAGE);

        if (page === 'prev') {
            currentPage = Math.max(1, currentPage - 1);
        } else if (page === 'next') {
            currentPage = Math.min(totalPages, currentPage + 1);
        } else if (typeof page === 'number' && page >= 1 && page <= totalPages) {
            currentPage = page;
        } else {
            console.error('Invalid page number:', page);
            return;
        }

        document.querySelector('.games-header').scrollIntoView({ behavior: 'smooth' });

        updateDisplay();
    }

    function playRandomGame() {
        const randomIndex = Math.floor(Math.random() * games.length);
        const randomGame = games[randomIndex];
        
        // Use the existing handleGameClick function to launch the game
        handleGameClick(
            new Event('click'), 
            randomGame.title, 
            randomGame.path
        );
    }
    </script>
    <script src="https://cdn.jsdelivr.net/particles.js/2.0.0/particles.min.js"></script>
    <script src="js/particles-config.js?v=<?php echo time(); ?>"></script>
</body>
</html>
