-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Gazdă: 127.0.0.1
-- Timp de generare: iul. 03, 2023 la 07:17 PM
-- Versiune server: 10.4.27-MariaDB
-- Versiune PHP: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Bază de date: `mogds`
--

-- --------------------------------------------------------

--
-- Structură tabel pentru tabel `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `admin_email` varchar(200) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Eliminarea datelor din tabel `admin`
--

INSERT INTO `admin` (`admin_id`, `username`, `admin_email`, `password`) VALUES
(2, 'daniel', 'danycsov@yahoo.com', '$2y$10$M474QogE1QNJWjg.Kg2X7OLRBSONJ9HDnzuR4vCytRk9NbxX99cwW'),
(3, 'danielg', 'danielg@yahoo.com', '$2y$10$mIitnf8S/ofCfeAIwUB02ORQJnOomD2SPx1E2uw88Eb8QuVk1o6FS');

-- --------------------------------------------------------

--
-- Structură tabel pentru tabel `brands`
--

CREATE TABLE `brands` (
  `brand_id` int(11) NOT NULL,
  `brand_title` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Eliminarea datelor din tabel `brands`
--

INSERT INTO `brands` (`brand_id`, `brand_title`) VALUES
(8, 'Apple'),
(9, 'Samsung'),
(10, 'Sony'),
(11, 'Motorola'),
(12, 'Oppo');

-- --------------------------------------------------------

--
-- Structură tabel pentru tabel `cart_details`
--

CREATE TABLE `cart_details` (
  `item_id` int(11) NOT NULL,
  `ip_address` varchar(255) NOT NULL,
  `quantity` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structură tabel pentru tabel `categories`
--

CREATE TABLE `categories` (
  `category_id` int(11) NOT NULL,
  `category_title` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Eliminarea datelor din tabel `categories`
--

INSERT INTO `categories` (`category_id`, `category_title`) VALUES
(6, 'Phone'),
(7, 'Accessories'),
(8, 'Tablet'),
(9, 'Headphones'),
(10, 'Smartwatch');

-- --------------------------------------------------------

--
-- Structură tabel pentru tabel `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `amount_due` int(255) NOT NULL,
  `invoice_number` int(255) NOT NULL,
  `total_products` int(255) NOT NULL,
  `order_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `order_status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Eliminarea datelor din tabel `orders`
--

INSERT INTO `orders` (`order_id`, `user_id`, `amount_due`, `invoice_number`, `total_products`, `order_date`, `order_status`) VALUES
(4, 3, 6426, 906082998, 1, '2023-07-01 08:43:14', 'Complete'),
(5, 3, 321, 1189117617, 1, '2023-07-01 00:51:18', 'pending'),
(6, 3, 321, 739623802, 1, '2023-07-01 00:52:15', 'pending'),
(7, 3, 1284, 1332646792, 1, '2023-07-01 01:11:53', 'pending'),
(8, 3, 7068, 1399097493, 2, '2023-07-01 01:15:24', 'pending'),
(10, 3, 0, 332579625, 0, '2023-07-01 01:20:09', 'pending'),
(12, 3, 7068, 1866404958, 2, '2023-07-01 08:46:40', 'pending'),
(13, 3, 4536, 1469808715, 3, '2023-07-02 14:11:01', 'pending'),
(14, 3, 18144, 1212219627, 2, '2023-07-02 14:14:15', 'pending'),
(15, 3, 18144, 1732823998, 2, '2023-07-02 14:14:57', 'pending'),
(16, 3, 18144, 1290420891, 2, '2023-07-02 14:49:15', 'pending');

-- --------------------------------------------------------

--
-- Structură tabel pentru tabel `payments`
--

CREATE TABLE `payments` (
  `payment_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `invoice_number` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  `payment_mode` varchar(255) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Eliminarea datelor din tabel `payments`
--

INSERT INTO `payments` (`payment_id`, `order_id`, `invoice_number`, `amount`, `payment_mode`, `date`) VALUES
(3, 20, 630495354, 6708, 'Cash on Delivery', '2023-07-02 15:11:06'),
(4, 21, 1636618326, 3574, 'Cash on Delivery', '2023-07-02 22:59:15');

-- --------------------------------------------------------

--
-- Structură tabel pentru tabel `pending`
--

CREATE TABLE `pending` (
  `order_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `invoice_number` int(255) NOT NULL,
  `item_id` int(11) NOT NULL,
  `quantity` int(255) NOT NULL,
  `order_status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Eliminarea datelor din tabel `pending`
--

INSERT INTO `pending` (`order_id`, `user_id`, `invoice_number`, `item_id`, `quantity`, `order_status`) VALUES
(1, 3, 2146214145, 39, 2, 'pending'),
(2, 3, 906082998, 39, 2, 'pending'),
(3, 3, 1189117617, 38, 1, 'pending'),
(4, 3, 739623802, 38, 1, 'pending'),
(5, 3, 1332646792, 38, 4, 'pending'),
(6, 3, 1399097493, 39, 2, 'pending'),
(7, 3, 819984117, 38, 1, 'pending'),
(8, 3, 2117208231, 38, 1, 'pending'),
(9, 3, 1866404958, 39, 2, 'pending'),
(10, 3, 1469808715, 41, 3, 'pending'),
(11, 3, 1212219627, 41, 12, 'pending'),
(12, 3, 1732823998, 41, 12, 'pending'),
(13, 3, 1290420891, 41, 12, 'pending'),
(14, 3, 42534786, 40, 1, 'pending'),
(15, 3, 42534786, 41, 2, 'pending'),
(16, 3, 566570756, 40, 3, 'pending'),
(17, 3, 566570756, 41, 5, 'pending'),
(18, 3, 508075712, 40, 5, 'pending'),
(19, 3, 508075712, 41, 1, 'pending'),
(20, 3, 630495354, 41, 5, 'pending'),
(21, 3, 1636618326, 57, 3, 'pending');

-- --------------------------------------------------------

--
-- Structură tabel pentru tabel `product`
--

CREATE TABLE `product` (
  `item_id` int(11) NOT NULL,
  `brand_id` int(11) NOT NULL,
  `item_name` varchar(255) NOT NULL,
  `item_price` double(10,2) NOT NULL,
  `item_image1` varchar(255) NOT NULL,
  `item_description` text NOT NULL,
  `item_key` varchar(255) NOT NULL,
  `category_id` int(11) NOT NULL,
  `item_image2` varchar(255) NOT NULL,
  `item_image3` varchar(255) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Eliminarea datelor din tabel `product`
--

INSERT INTO `product` (`item_id`, `brand_id`, `item_name`, `item_price`, `item_image1`, `item_description`, `item_key`, `category_id`, `item_image2`, `item_image3`, `date`, `status`) VALUES
(42, 8, 'Incarcator wireless Apple MagSafe Charger, Alb', 34.00, 'images/143714_1.jpg', 'Incarcatorul MagSafe simplifica la maximum incarcarea wireless. Magnetii perfect aliniati se ataseaza la iPhone 12 sau iPhone 12 Pro si furnizeaza incarcare wireless mai rapida, de pana la 15 W.\r\nIncarcatorul MagSafe pastreaza compatibilitatea cu standardul de incarcare Qi, prin urmare poate fi utilizat pentru a incarca wireless un iPhone 8 sau ulterior, precum si modelele AirPods cu caseta de incarcare wireless, similar oricarui incarcator certificat Qi.\r\nFacilitatea de aliniere magnetica se aplica doar pentru modelele iPhone 12 si iPhone 12 Pro. Adaptorul de alimentare Apple USB-C de 20 W se comercializeaza separat.', 'Apple, Incarcator , wireless, magsafe, alb', 7, 'images/143714_2.jpg', 'images/143714_3.jpg', '2023-07-02 22:27:42', ''),
(43, 8, 'Casti True Wireless Apple AirPods Pro2 (2022)', 272.00, 'images/apple_airpods_pro2_case.jpg', 'Reconstruite pentru sunet\r\n\r\nAirPods Pro2 au fost reproiectate pentru a oferi pana la de doua ori mai multa anulare activa a zgomotului.\r\nAdaptive Transparency reduce zgomotul extern, in timp ce Personalized Spatial Audio va cufunda in sunet.\r\nO singura incarcare ofera pana la 6 ore de viata a bateriei.*Iar controlul tactil va permite sa reglati cu usurinta volumul printr-o glisare.\r\nCarcasa cu incarcare MagSafe regandita este o minune in sine, cu Precision Finding, difuzoare incorporate si bucla pentru snur.\r\n*Durata de viata a bateriei poate diferi in functie de modul de utilizare.\r\nReconstruite\r\nCalitate audio superioara\r\nCalitate audio superioara\r\n\r\nCipul H2 imbunatatit asigura o anulare mai inteligenta a zgomotului si un sunet tridimensional. Egalizatorul adaptiv potriveste muzica la urechile dvs. in timp real pentru a oferi note inalte clare, curate si bas profund si bogat, cu o claritate uluitoare.\r\nDe pana la de 2 ori mai multa anulare a zgomotului\r\n\r\nAnularea activa a zgomotului anuleaza acum de doua ori mai mult zgomotul nedorit, astfel incat nimic nu va intrerupe ascultarea in timpul unei navete si atunci cand trebuie sa va concentrati.\r\nIar modul Transparenta Adaptiva reduce si ajusteaza intensitatea zgomotelor puternice la 48.000 de ori pe secunda, astfel incat sa puteti ramane conectat la lumea din jurul tau in orice cadru.\r\n2 ori mai multa anulare a zgomotului\r\nAscultare personalizata\r\nAscultare personalizata\r\n\r\nAlegeti dintre patru dimensiuni de varfuri flexibile din silicon (XS, S, M, L) pentru o etansare acustica si o potrivire ideale.\r\nAudio Spatial Personalizat cu urmarirea dinamica a capului adapteaza experienta de ascultare prin plasarea precisa a elementelor sonore in spatiul din jurul tau.\r\nEgalizatorul adaptiv acordeaza muzica la urechile tale, astfel incat sa auzi de fiecare data o redare detaliata constant.\r\nDurata de viata extinsa a bateriei\r\n\r\nAcum va puteti bucura de pana la 6 ore de timp de ascultare cu o singura incarcare si de pana la 30 de ore de ascultare cu carcasa de incarcare MagSafe.\r\nReincarcati husa de incarcare MagSafe cu un Apple Watch sau un incarcator MagSafe. De asemenea, puteti utiliza conectorul Lightning sau un incarcator certificat Qi.\r\nDurata de viata extinsa a bateriei\r\nCarcasa de incarcare reproiectata\r\nCarcasa de incarcare reproiectata\r\n\r\nCarcasa de incarcare MagSafe reproiectata include cipul U1 cu Precision Finding pentru a va ajuta sa identificati locatia carcasei dvs. Si daca sunteti in apropiere si este ascunsa, puteti reda sunete din difuzorul incorporat.\r\nO bucla incorporata pentru snur va permite sa va atasati husa la un rucsac sau o geanta de mana, astfel incat sa fie intotdeauna la indemana.\r\nAtat AirPods Pro, cat si husa de incarcare MagSafe sunt construite pentru a infrunta elementele, cu rezistenta IPX4 la transpiratie si apa.\r\nMai magic ca niciodata\r\n\r\nAirPods Pro2 ofera o experienta si mai simpla decat modelul original. Controlul tactil va permite sa gestionati functiile de redare de la stem si sa reglati volumul cu o glisare usoara in sus sau in jos.\r\nRugati-o pe Siri sa va citeasca mesajele si alertele importante pe masura ce sosesc.\r\nPartajati cu usurinta o melodie sau o emisiune intre oricare doua seturi de AirPods cu Partajare audio.\r\nSi, ca intotdeauna, AirPods Pro se conecteaza magic la iPhone sau Apple Watch si sunetul ramane cu dumneavoastra atunci cand comutati intre', 'Apple , headphone , wireless, airpod, pro, casti', 9, 'images/apple_airpods_pro2_free.jpg', 'images/apple_airpods_pro2_front.jpg', '2023-07-02 22:29:25', ''),
(44, 8, 'Casti True Wireless Apple AirPods Gen 3 (2022)', 191.00, 'images/apple_airpods3_with_lightning_charging_case_case.jpg', 'Apple AirPods Gen 3 (2022), Carcasa incarcare Lightning, Bluetooth\r\nPartajare audio\r\nPartajare audio\r\n\r\nPartajati cu usurinta o melodie sau un show intre oricare doua AirPods. Pur si simplu aduceti AirPods langa iPhone, iPad sau Apple TV pe care il ascultati si conectati-va instantaneu.\r\nSpatial Audio\r\n\r\nSpatial Audio cu urmarirea dinamica a capului plaseaza sunete in jurul tau pentru a crea o experienta de ascultare tridimensionala pentru muzica, emisiuni TV, filme si multe altele - scufundandu-te in sunete din toate directiile, astfel incat sa simti ca te afli in propria ta sala de concerte sau la teatru.\r\nSpatial Audio\r\nMuzica intr-o nota personala\r\nMuzica intr-o nota personala\r\n\r\nEgalizarea adaptiva armonizeaza automat muzica la urechile tale. Microfoanele orientate spre interior detecteaza ce asculti, apoi ajusteaza frecventele joase si medii pentru a reda detaliile complexe ale fiecarei melodii. Totul personalizat pentru tine in timp real.\r\nDezactiveaza vantul\r\n\r\nAcoperit intr-o plasa acustica speciala, un microfon incorporat in fiecare casca minimizeaza zgomotul vantului atunci cand sunteti in apel - astfel incat vocea dvs. sa fie intotdeauna auzita tare si clar.\r\nDezactiveaza vantul\r\nCalitate vocala HD pentru FcaeTime\r\nCalitate vocala HD pentru FaceTime\r\n\r\nConectati-va pe FaceTime in calitate clara HD, cu un nou codec AAC-ELD. Si cu suport pentru spatial audio, apelurile de grup FaceTime suna mai fidel decat oricand.\r\nStil in fiecare ureche\r\n\r\nCu un design conturat si o tija mai scurta, AirPods sunt concepute pentru a va directiona sunetul in urechi - intr-un aspect rafinat pe care oricine il poate aprecia.\r\nStil in fiecare ureche\r\nControl perfect\r\nControl perfect\r\n\r\nForce Sensor va ofera si mai mult control asupra divertismentului. Puteti apasa pentru a reda, intrerupe si sari peste melodii sau sa raspundeti si sa terminati apelurile.\r\nRezistente la apa\r\n\r\nAirPods Gen 3 sunt rezistente la apa si transpiratie IPX4, astfel ca vor rezista la ploaie sau la antrenamente intense.\r\nRezistente la apa\r\nO carcasa plina de energie\r\nO carcasa plina de energie\r\n\r\nComplet incarcata, carcasa va ofera pana la 30 de ore autonomie de ascultare. Iar incarcarea AirPods in carcasa timp de doar 5 minute genereaza aproximativ o ora timp de ascultare.\r\nConexiune instantanee\r\n\r\nPlasati AirPods langa iPhone sau iPad si atingeti Conectare pentru a asocia cu fiecare dispozitiv din contul dvs. iCloud. Daca redati muzica pe computerul dvs. Mac, veti putea raspunde la un apel de pe iPhone - fara a fi nevoie sa schimbati dispozitivul.\r\nConexiune instantee\r\n\r\nUn mare simt al detectarii\r\n\r\nUn senzor imbunatatit de detectare a purtarii cunoaste diferenta dintre urechea dvs. si alte suprafete, astfel incat sunetul se reda numai atunci cand purtati AirPods - si face pauze cand sunt in buzunar sau pe masa.\r\nFind My App imbunatatita\r\n\r\nUrmariti-va AirPod-urile cu Find My App. Vedeti cat de apropiate sunt cu vizualizarea de proximitate, primiti alerte de separare daca nu se afla in raza de actiune Bluetooth - sau pot sa redea un sunet pentru a le putea localiza.', 'apple, casti, headphone, alb , wireless, airpod', 9, 'images/apple_airpods3_with_lightning_charging_case_free.jpg', 'images/apple_airpods3_with_lightning_charging_case_front.jpg', '2023-07-02 22:33:06', ''),
(45, 8, 'Wireless Apple MagSafe DuoCharger', 130.00, 'images/incarcator_wireless_apple_magsafe_duo_charger.jpg', 'MagSafe este un nou ecosistem de accesorii pentru atasare usoara si incarcare wireless mai rapida. Cu combinatii interminabile, exista un mix care se potriveste cu orice stil. Incarcatorul MagSafe Duo incarca in mod convenabil iPhone-ul dvs compatibil, Apple Watch, carcasa de incarcare wireless pentru AirPod-uri si alte dispozitive certificate Qi. Pur si simplu asezati dispozitivele pe incarcator si o incarcare constanta si eficienta incepe imediat. Incarcatorul se pliaza convenabil, astfel incat sa il puteti lua cu usurinta oriunde ati merge.', 'Incarcator , wireless, magsafe, apple , alb', 7, 'images/incarcator_wireless_apple_magsafe_duo_charger_alb.jpg', 'images/incarcator_wireless_apple_magsafe_duo_charger_alb_1.jpg', '2023-07-02 22:56:46', ''),
(46, 8, 'Tastatura Apple Smart MX3L2RO/A', 173.00, 'images/tastatura_apple_smart_2.jpg', 'Tastatura inteligenta combina tehnologii avansate pentru a crea un dispozitiv unic. Este o tastatura de dimensiuni complete, in totalitate portabila si se conecteaza la iPad si iPad Air cu ajutorul conectorului smart. Trebuie doar sa atasati tastatura smart si sa incepeti sa tastati. Si cand ati terminat, se pliaza si devine o husa subtire si usoara.', 'tastatura, apple, smart, negru', 7, 'images/tastatura_apple_smart-1_1.jpg', 'images/tastatura_apple_smart-2_1.jpg', '2023-07-02 22:34:24', ''),
(47, 8, 'Apple mhje3zm/a, USB-C, 20W', 30.00, 'images/143502_1.jpg', 'Adaptorul de alimentare Apple USB-C de 20 W ofera incarcare rapida si eficienta acasa, la birou sau in deplasare. Desi adaptorul de alimentare este compatibil cu orice dispozitiv USB-C, Apple recomanda folosirea acestuia cu iPad Pro si iPad Air pentru o performanta optima de incarcare. De asemenea, poate fi folosit cu iPhone 8 sau un model mai recent pentru a profita la maximum de caracteristica de incarcare rapida. Cablul de incarcare se comercializeaza separat.', 'incarcator, iphone , apple, alb', 7, 'images/143502_2.jpg', 'images/incarcator_retea_apple_mhje3zm-a.jpg', '2023-07-02 22:57:30', ''),
(48, 8, 'iPhone 14 Pro Max 5G, 128GB, Silver', 1270.00, 'images/iphone_14_pro_silver.jpg', 'Suprinde detalii incredibile cu noua camera principala de 48MP. Bucura-te de experienta iPhone intr-un mod cu totul nou cu Dynamic Island si ecranul Mereu activat. Detectare accident, o noua functionalitate de siguranta, suna dupa ajutor daca tu nu poti.\r\niPhone 14 Pro si Pro Max\r\nDynamic Island, un nou mod magic de a interactiona cu iPhone.\r\nEcran mereu activat pentru informatiile pe care le doresti, dintr-o singura privire.\r\nDetectare accidente pentru ajutor atunci cand este mai multa nevoie.\r\nAutonomie uimitoare a bateriei, chiar si cu atat de multe noi functionalitati.\r\nSistem de camere Pro, cu camera principala de 48MP. Patru optiuni de zoom. Selfie-uri mai clare.\r\nModul actiune, pentru a inregistra clipuri stabile cand esti in miscare.\r\nA16 Bionic, cel mai avansat cip de smartphone.\r\nConexiune 5G, pentru streaming, jocuri si descarcari la viteza uimitoare\r\nProcesor A16\r\nStil si substanta\r\nOtel inoxidabil de calitate chirurgicala. Afisaje de 6.1 si 6.7 inchi Super Retina XDR cu ecran Always-On si tehnologie ProMotion protejate de Ceramic Shield, cea mai rezistenta sticla de smartphone. Rezistenta la stropire, apa si praf. Totul in patru culori Pro.\r\niPhone 14 Pro si Pro Max\r\nAccesorii MagSafe\r\nPune-i o carcasa magnetica, un portofel sau ambele. Si bucura-te de incarcare wireless mai rapida. Exploreaza accesoriile MagSafe.', '14 , iphone , pro max , 5G , silver', 6, 'images/iphone_14_pro_silver-2_a295def4.jpg', 'images/iphone_14_pro_max_silver_pdp.jpg', '2023-07-02 22:37:56', ''),
(49, 8, 'iPhone 14 Pro Max 5G, 128GB, Gold', 1270.00, 'images/iphone_14_pro_gold-1_6d712f47.jpg', 'Suprinde detalii incredibile cu noua camera principala de 48MP. Bucura-te de experienta iPhone intr-un mod cu totul nou cu Dynamic Island si ecranul Mereu activat. Detectare accident, o noua functionalitate de siguranta, suna dupa ajutor daca tu nu poti.\r\niPhone 14 Pro si Pro Max\r\nDynamic Island, un nou mod magic de a interactiona cu iPhone.\r\nEcran mereu activat pentru informatiile pe care le doresti, dintr-o singura privire.\r\nDetectare accidente pentru ajutor atunci cand este mai multa nevoie.\r\nAutonomie uimitoare a bateriei, chiar si cu atat de multe noi functionalitati.\r\nSistem de camere Pro, cu camera principala de 48MP. Patru optiuni de zoom. Selfie-uri mai clare.\r\nModul actiune, pentru a inregistra clipuri stabile cand esti in miscare.\r\nA16 Bionic, cel mai avansat cip de smartphone.\r\nConexiune 5G, pentru streaming, jocuri si descarcari la viteza uimitoare\r\nProcesor A16\r\nStil si substanta\r\nOtel inoxidabil de calitate chirurgicala. Afisaje de 6.1 si 6.7 inchi Super Retina XDR cu ecran Always-On si tehnologie ProMotion protejate de Ceramic Shield, cea mai rezistenta sticla de smartphone. Rezistenta la stropire, apa si praf. Totul in patru culori Pro.\r\niPhone 14 Pro si Pro Max\r\nAccesorii MagSafe\r\nPune-i o carcasa magnetica, un portofel sau ambele. Si bucura-te de incarcare wireless mai rapida. Exploreaza accesoriile MagSafe.', 'iphone , gold , 14 , pro max, apple', 6, 'images/iphone_14_pro_max_gold_.jpg', 'images/iphone_14_pro_max_gold_pdp.jpg', '2023-07-02 22:38:46', ''),
(50, 8, 'iPhone 14 Pro Max 5G, 256GB, Silver', 1390.00, 'images/iphone_14_pro_silver.jpg', 'Suprinde detalii incredibile cu noua camera principala de 48MP. Bucura-te de experienta iPhone intr-un mod cu totul nou cu Dynamic Island si ecranul Mereu activat. Detectare accident, o noua functionalitate de siguranta, suna dupa ajutor daca tu nu poti.\r\niPhone 14 Pro si Pro Max\r\nDynamic Island, un nou mod magic de a interactiona cu iPhone.\r\nEcran mereu activat pentru informatiile pe care le doresti, dintr-o singura privire.\r\nDetectare accidente pentru ajutor atunci cand este mai multa nevoie.\r\nAutonomie uimitoare a bateriei, chiar si cu atat de multe noi functionalitati.\r\nSistem de camere Pro, cu camera principala de 48MP. Patru optiuni de zoom. Selfie-uri mai clare.\r\nModul actiune, pentru a inregistra clipuri stabile cand esti in miscare.\r\nA16 Bionic, cel mai avansat cip de smartphone.\r\nConexiune 5G, pentru streaming, jocuri si descarcari la viteza uimitoare\r\nProcesor A16\r\nStil si substanta\r\nOtel inoxidabil de calitate chirurgicala. Afisaje de 6.1 si 6.7 inchi Super Retina XDR cu ecran Always-On si tehnologie ProMotion protejate de Ceramic Shield, cea mai rezistenta sticla de smartphone. Rezistenta la stropire, apa si praf. Totul in patru culori Pro.\r\niPhone 14 Pro si Pro Max\r\nAccesorii MagSafe\r\nPune-i o carcasa magnetica, un portofel sau ambele. Si bucura-te de incarcare wireless mai rapida. Exploreaza accesoriile MagSafe.', 'iphone , 14 , pro max, apple , 5G', 6, 'images/iphone_14_pro_silver-2_a295def4.jpg', 'images/iphone_14_pro_max_silver_pdp.jpg', '2023-07-02 22:40:08', ''),
(51, 8, 'iPad 10 (2022), 10.9\", 256 GB, Silver', 715.00, 'images/ipad10_silver_wifi_fata-spate_1_1.jpg', 'Noul iPad este regandit in culori pentru a fi mai capabil, mai intuitiv si chiar mai distractiv. Cu un display complet nou, un ecran Liquid Retina de 10,9 inchi si patru culori superbe, iPad ofera o modalitate puternica de a face lucruri, de a crea si de a ramane conectat. Adauga accesorii esentiale concepute special pentru iPad si bucura-te de o versatilitate infinita pentru tot ceea ce iti place sa faci.\r\n\r\nCreati ce doriti\r\nExprimati-va, desenati si faceti brainstorming pe noul iPad. Displayul uimitor Liquid Retina de 10,9 inchi reprezinta un canvas incredibil. Astfel, poti mazgali, lua notite, marca documente si multe altele cu Apple Pencil.\r\nCreati ce doriti\r\nRamaneti in cadru\r\nCu noua camera frontala Ultra Wide de 12 MP, veti ramane perfect in cadru, fie ca sunteti intr-un apel FaceTime, participati la o conferinta video sau inregistrati un video selfie, iar cu Center Stage, camera se ajusteaza automat pentru a va mentine centrat in cadru.\r\n\r\nScrieti cu usurinta\r\nTastati confortabil si utilizati un trackpad pentru sarcini de precizie, cum ar fi editarea unui excel, cu Magic Keyboard Folio. Reglati rapid volumul sau cautati un fisier cu ajutorul randului de functii cu 14 taste. Designul versatil are doua piese care se ataseaza magnetic: o tastatura detasabila si un panou spate de protectie cu un suport reglabil pentru vizualizare flexibila.\r\n\r\nApple Pencil\r\nApple Pencil\r\n\r\nApple Pencil este excelent pentru a lua notite, a scrie in jurnal si pentru tot felul de desene si ilustratii. Ofera o precizie perfecta la nivel de pixel si un decalaj imperceptibil, astfel ca este la fel de natural de folosit ca un creion.\r\nDesign versatil\r\n\r\nDesenati, pictati si scrieti cu Apple Pencil. Tastati confortabil, folositi un trackpad si bucurati-va de continut cu designul versatil din doua piese al Magic Keyboard Folio. Puteti folosi comenzile rapide familiare de la tastatura sau trackpadul cu clic oriunde, obtinand o experienta de tastare incredibila.\r\nDesign versatil\r\n\r\nUtilizare cu usurinta\r\n\r\niPadOS le reuneste pe toate si face ca totul pe iPad sa fie usor si fara probleme. Ruleaza-ti aplicatiile preferate una langa alta, editeaza si partajeaza fotografii cu altii si acceseaza toate fisierele tale.\r\nProductivitate si rapiditate\r\n\r\nToate se rezolva de pe un singur dispozitiv. Luati notite, colaborati si lucrati fara probleme intre aplicatii. De la diagrame la retete de placinta, iPad este conceput pentru toate tipurile de productivitate.\r\n\r\nCip A14 Bionic\r\nCip A14 Bionic\r\n\r\nCipul A14 Bionic ofera putere si performanta pentru orice activitate. Editati un videoclip 4K in iMovie, planificati o vacanta cu prietenii pe tot globul sau jucati un joc cu grafica intensiva. Cu o autonomie a bateriei de o zi intreaga, puteti face totul fara sa sariti peste timp.\r\nMicrofoane incorporate de inalta calitate\r\n\r\nInregistrati si perfectionati-va de oriunde, cu microfoane incorporate de inalta calitate si difuzoare stereo landscape. Incepeti un podcast, compuneti un ritm, compuneti o coloana sonora pentru un film - proiectele dvs. creative suna fantastic.\r\nMicrofoane incorporate de inalta calitate\r\nCamera foto principala de 12 MP\r\nCamera foto principala de 12 MP\r\n\r\nFilmati continut cu camera foto principala de 12 MP. Faceti fotografii si retusati-le, editati clipuri video in 4K si scanati si marcati documente - totul pe iPad.\r\nWiFi sau conexiuni 5G\r\n\r\nDescarcati fisiere, jucati jocuri online si transmiteti filme prin Wi-Fi 6, iar atunci cand sunteti departe de Wi-Fi, puteti accesa conexiuni ultrarapide cu 5G.\r\nWiFi sau conexiuni 5G\r\nUrmariti\r\nUrmariti\r\n\r\nUrmareste emisiunile, foloseste aplicatii si experimenteaza jocurile tale preferate pe frumosul ecran Liquid Retina de 10,9 inchi si cu tehnologia True Tone, este confortabil de privit in orice lumina.\r\nInvatati\r\n\r\nInvatati o noua limba cu Duolingo, inscrieti-va la un MasterClass si duceti lectiile la nivelul urmator cu experiente AR captivante. Poti invata aproape orice cu iPad.\r\nInvatati\r\nSharePlay\r\nSharePlay\r\n\r\nExperimentati jocuri cu grafica intensiva. Invitati-va prietenii sa se alature cu SharePlay. Puteti, de asemenea, sa asociati controlerul dvs. preferat de jocuri cu iPad.\r\nAplicatii uimitoare? Absolut!\r\n\r\niPad 10 este dotat cu aplicatii puternice si capabile, cum ar fi Photos, Maps, Messages, Apple News, Mail si Safari. Si, cu peste un milion de aplicatii in App Store concepute special pentru iPad, vei gasi aplicatia potrivita pentru orice vrei sa faci. Gestioneaza un proiect cu Trello, colaboreaza pe canvas infinit din Freeform sau termina-ti proiectul in Microsoft Word.', 'tablet , apple, silver , ipad', 8, 'images/ipad10_silver_wifi_spate-fata_1_1.jpg', 'images/ipad10_silver_wifi_cutie_1_1.jpg', '2023-07-02 22:41:30', ''),
(52, 9, 'Fast Wireless Charger pentru Samsung', 30.00, 'images/incarcator_samsung_ep-or900bbegww_fata.jpg', 'Noul incarcator wireless pentru ceasuri este acum actualizat pentru incarcare rapida cu USB-C. Asezati Galaxy Watch5 in pozitie orizontala, iar incarcatorul se va fixa magnetic pe ceas si apoi se va ocupa de incarcare.\r\nusb-c\r\nAtentie! Incarcati!\r\nCeasul dumneavoastra este insotitorul dumneavoastra toata ziua si toata noaptea. De acum incolo, nu va mai trebui sa va scoateti ceasul pentru mult timp. Ajungeti la 45% in doar 30 de minute cu functia de incarcare rapida care accepta o tensiune mai mare de 5V/2A si PD.', 'samsung, incarcator , wireless', 7, 'images/incarcator_samsung_ep-or900bbegww_lat.jpg', 'images/incarcator_samsung_ep-or900bbegww_per.jpg', '2023-07-02 22:42:30', ''),
(53, 9, 'Samsung, Type C, Negru', 20.00, 'images/135357_3.jpg', 'Incarcator retea Samsung, Type C, Negru\r\nSe potriveste la orice device cu mufa Type C sau se poate folosi doar adaptorul de priza cu alt cablu destinat telefonului dumneavostra.\r\n\r\n– amperaj: 2000 mAh\r\n– alimentare: 100-240V\r\n– incarcare rapida maxim 15W\r\n– tensiune iesire: 5V\r\n– cablu cu conector USB Type-C inclus\r\n– compatibilitate: universal USB Type-C', 'samsung , incarcator, negru , type-c', 7, 'images/135357_4.jpg', 'images/135357_1.jpg', '2023-07-02 22:43:23', ''),
(54, 9, 'Galaxy Watch 5', 210.00, 'images/smartwatch_samsung_galaxy_watch_4_44mm_1.jpg', 'Smartwatch Samsung Galaxy Watch 5, 44mm, Bluetooth, Graphite', 'ceas , smartwatch , galaxy , watch 5', 10, 'images/smartwatch_samsung_galaxy_watch_4_44mm_fata_1.jpg', 'images/smartwatch_samsung_galaxy_watch_4_44mm_lateral_1.jpg', '2023-07-02 22:44:31', ''),
(55, 9, 'In-Ear Samsung EO-IA500BBEGWW, Negru', 8.00, 'images/148970_4.jpg', 'Casti audio In-Ear Samsung EO-IA500BBEGWW, Negru\r\nDescoperiti un sunet autentic cu difuzoare bidirectionale\r\nDispunand de difuzoare bidirectionale cu un woofer si un tweeter dedicate care contribuie la o amprenta de sunet uniforma, castile Samsung de 3.5 mm ofera un sunet bogat, redat prin claritate si echilibru. Lasa-te prins in deliciul muzical in timp ce in urechile tale se intrepatrund echilibrat sunete inalte, medii si joase.\r\nDescoperiti un sunet autentic cu difuzoare bidirectionale\r\nPotrivirea perfecta pentru sunet si confort\r\nFacute sa le simti la fel de bine pe cat suna, designul tip canal hibrid al castilor Samsung de 3.5 mm pastreaza identitatea de design Samsung. Fiecare casca este creata pentru a se aseza confortabil in ureche - alege doar optiunile de varf incluse pentru a se potrivi corect.', 'headphone , samsung , negru , in-ear', 9, 'images/148970_2.jpg', 'images/148970_1.jpg', '2023-07-02 22:45:21', ''),
(56, 9, 'Galaxy S23 Ultra, 256GB, 8GB, Cream', 1108.00, 'images/telefon_mobil_samsung_galaxy_s23_ultra_cream.jpg', 'Realizeaza fotografii si videoclipuri clare, de la apus si pana in zori. Cel mai avansat senzor pentru camera foto si cel mai rapid procesor Galaxy accepta lumina redusa si reduc zgomotul de imagine. Si chiar si obiectivul camerei foto clarifica captura, prin atenuarea luminii.\r\nLumina redusa. Aparat foto. Actiune\r\nPutere pentru cei care nu iau pauza\r\nMaximizeaza-ti timpul liber cu Snapdragon 8 Gen 2 Mobile Platform pentru Galaxy, cel mai rapid Snapdragon din lume. Prin functii imbunatatite la nivel general, absolut totul, de la jocuri pana la difuzare in flux, este optimizat si se desfasoara perfect, fara a consuma bateria.\r\nPutere pentru cei care nu iau pauza\r\nCreat cu gandul la planeta\r\nUtilizarea materialelor recunoscute si certificate face ca acesta sa fie cel mai ecologic smartphone realizat de noi. Sticla reciclata si filmul PET accentueaza exteriorul telefonului, iar cutia din hartie reciclata il integreaza in mediul natural din momentul in care il iei in mana.\r\nCreat cu gandul la planeta\r\nPutere bruta, de la fotografiere pana la editare\r\nTreci la Expert RAW, pentru a obtine mai multe detalii, chiar si in intuneric. In astrofotografie seteaza manual expunerea sau lasa camera foto sa aleaga, apoi indreapt-o spre cer, pentru a surprinde planete si constelatii cu claritate.\r\nPutere bruta, de la fotografiere pana la editare\r\nS Pen incorporat\r\nS Pen pastreaza vie mostenirea Note. In plus, te ajuta sa renunti la dependenta de notebook-uri, facand schite si notificari fara efort si intr-un mod ecologic.\r\nS Pen incorporat\r\nUn viitor mai luminos la orizont\r\nUn viitor mai luminos la orizont\r\n\r\nDynamic AMOLED 2X ofera detalii clare si colorate pe ecran, indiferent daca luminozitatea este la un nivel scazut sau maxim. Iar tehnologia de 120 Hz optimizeaza inteligent rata de reimprospatare, pentru a oferi cursivitate actiunii si pentru a economisi baterie.\r\nDu-ti confruntarile la nivel inalt\r\n\r\nFa cunostinta cu bateria de lunga durata, creata pentru a-ti alimenta victoriile. Aceasta baterie inteligenta, de 5000 mAh (tipica), economiseste energie pentru timpul de functionare, astfel incat sa te poti juca si sa transmiti in flux pe parcursul noptii.\r\nDu-ti confruntarile la nivel inalt\r\nMultitasking si Control multiplu\r\nMultitasking si Control multiplu\r\n\r\nIncepe de pe telefon si pe masura ce ideile tale se dezvolta treci pe alt dispozitiv. Cu continuitate pe toate echipamentele Galaxy, poti folosi un singur mouse, o singura tastatura sau un singur touchpad pentru a plasa cu usurinta text si imagini pe PC/ tableta, apoi revino la telefon atunci cand este timpul sa te deplasezi.\r\nDispozitivul tau Galaxy, asa cum iti place\r\n\r\nAcum este mai usor ca niciodata sa-ti configurezi telefonul, doar pentru tine. One UI maximizeaza personalizarea, permitandu-ti sa alegi aproape fiecare detaliu, de la ecrane de blocare si teme, la widget-uri si notificari. Ataseaza-i chiar si cheile, actul de identitate si biletele, in siguranta, intr-un singur loc, cu Samsung Wallet. Apoi, obtine cea mai buna forma a ta cu Samsung Health si Galaxy Watch5, care te ajuta sa-ti monitorizezi somnul, exercitiile fizice, compozitia corpului si multe altele.\r\nDispozitivul tau Galaxy, asa cum iti place\r\nAm simplificat pastrarea datelor tale\r\nAm simplificat pastrarea datelor tale\r\n\r\nEsti gata doar cu un simplu transfer Wi-Fi sau cu o autentificare rapida in contul tau Samsung. In chiar mai putini pasi, transferi aplicatiile, fotografiile, mesajele si multe altele, de pe orice sistem de operare pe noul tau telefon.', 's23 , ultra , samsung , galaxy , cream', 6, 'images/telefon_mobil_samsung_galaxy_s23_ultra_dual_sim_cream_ecran.jpg', 'images/telefon_mobil_samsung_galaxy_s23_ultra_dual_sim_cream_ecran_1.jpg', '2023-07-02 22:46:36', ''),
(57, 9, 'Galaxy S23 Ultra, 256GB, 8GB, Green', 1128.00, 'images/telefon_mobil_samsung_galaxy_s23_ultra_green.jpg', 'Realizeaza fotografii si videoclipuri clare, de la apus si pana in zori. Cel mai avansat senzor pentru camera foto si cel mai rapid procesor Galaxy accepta lumina redusa si reduc zgomotul de imagine. Si chiar si obiectivul camerei foto clarifica captura, prin atenuarea luminii.\r\nLumina redusa. Aparat foto. Actiune\r\nPutere pentru cei care nu iau pauza\r\nMaximizeaza-ti timpul liber cu Snapdragon 8 Gen 2 Mobile Platform pentru Galaxy, cel mai rapid Snapdragon din lume. Prin functii imbunatatite la nivel general, absolut totul, de la jocuri pana la difuzare in flux, este optimizat si se desfasoara perfect, fara a consuma bateria.\r\nPutere pentru cei care nu iau pauza\r\nCreat cu gandul la planeta\r\nUtilizarea materialelor recunoscute si certificate face ca acesta sa fie cel mai ecologic smartphone realizat de noi. Sticla reciclata si filmul PET accentueaza exteriorul telefonului, iar cutia din hartie reciclata il integreaza in mediul natural din momentul in care il iei in mana.\r\nCreat cu gandul la planeta\r\nPutere bruta, de la fotografiere pana la editare\r\nTreci la Expert RAW, pentru a obtine mai multe detalii, chiar si in intuneric. In astrofotografie seteaza manual expunerea sau lasa camera foto sa aleaga, apoi indreapt-o spre cer, pentru a surprinde planete si constelatii cu claritate.\r\nPutere bruta, de la fotografiere pana la editare\r\nS Pen incorporat\r\nS Pen pastreaza vie mostenirea Note. In plus, te ajuta sa renunti la dependenta de notebook-uri, facand schite si notificari fara efort si intr-un mod ecologic.\r\nS Pen incorporat\r\nUn viitor mai luminos la orizont\r\nUn viitor mai luminos la orizont\r\n\r\nDynamic AMOLED 2X ofera detalii clare si colorate pe ecran, indiferent daca luminozitatea este la un nivel scazut sau maxim. Iar tehnologia de 120 Hz optimizeaza inteligent rata de reimprospatare, pentru a oferi cursivitate actiunii si pentru a economisi baterie.\r\nDu-ti confruntarile la nivel inalt\r\n\r\nFa cunostinta cu bateria de lunga durata, creata pentru a-ti alimenta victoriile. Aceasta baterie inteligenta, de 5000 mAh (tipica), economiseste energie pentru timpul de functionare, astfel incat sa te poti juca si sa transmiti in flux pe parcursul noptii.\r\nDu-ti confruntarile la nivel inalt\r\nMultitasking si Control multiplu\r\nMultitasking si Control multiplu\r\n\r\nIncepe de pe telefon si pe masura ce ideile tale se dezvolta treci pe alt dispozitiv. Cu continuitate pe toate echipamentele Galaxy, poti folosi un singur mouse, o singura tastatura sau un singur touchpad pentru a plasa cu usurinta text si imagini pe PC/ tableta, apoi revino la telefon atunci cand este timpul sa te deplasezi.\r\nDispozitivul tau Galaxy, asa cum iti place\r\n\r\nAcum este mai usor ca niciodata sa-ti configurezi telefonul, doar pentru tine. One UI maximizeaza personalizarea, permitandu-ti sa alegi aproape fiecare detaliu, de la ecrane de blocare si teme, la widget-uri si notificari. Ataseaza-i chiar si cheile, actul de identitate si biletele, in siguranta, intr-un singur loc, cu Samsung Wallet. Apoi, obtine cea mai buna forma a ta cu Samsung Health si Galaxy Watch5, care te ajuta sa-ti monitorizezi somnul, exercitiile fizice, compozitia corpului si multe altele.\r\nDispozitivul tau Galaxy, asa cum iti place\r\nAm simplificat pastrarea datelor tale\r\nAm simplificat pastrarea datelor tale\r\n\r\nEsti gata doar cu un simplu transfer Wi-Fi sau cu o autentificare rapida in contul tau Samsung. In chiar mai putini pasi, transferi aplicatiile, fotografiile, mesajele si multe altele, de pe orice sistem de operare pe noul tau telefon.', 'samsung , s23 , ultra , green , galaxy', 6, 'images/telefon_mobil_samsung_galaxy_s23_ultra_256gb_8gb_dual_sim_green_1.jpg', 'images/telefon_mobil_samsung_galaxy_s23_ultra_256gb_8gb_dual_sim_green.jpg', '2023-07-02 22:47:56', ''),
(58, 9, 'Galaxy Tab S8', 645.00, 'images/tableta_samsung_galaxy_tab_s8_11_inch_128gb_8gb_wi-fi_gray_1.jpg', 'Puterea de a face mai mult\r\nConstruit pentru a lua distractia cu tine. Acest ecran LCD de 11\" are foarte multe de oferit. De la 5G la o baterie uriasa si o camera frontala Ultra Wide de 12 MP. Si, desigur, S Pen este inclus.\r\n\r\n• 11\" - Ecran LCD LTPS 1\r\n• 5G - HyperFast\r\n• 4 nm - Procesor\r\n• 8.000 mAh - Baterie (standard)\r\n• 12 MP - Camera frontala Ultra Wide\r\n• Cititor de amprente pe butonul de pornire\r\nS Pen se fixeaza la locul sau pentru a se incarca\r\nS Pen se fixeaza la locul sau pentru a se incarca\r\n \r\nS Pen se fixeaza la locul sau pentru a se incarca\r\n \r\nIndiferent de dimensiunea tabletei pe care o alegi, noul S Pen este inclus si se fixeaza magnetic in partea din spate Galaxy Tab S8 pentru incarcare.\r\n\r\nScrie, schiteaza sau deseneaza cele mai indraznete idei pentru a le transpune in realitate cu S Pen cu latenta ultra-scazuta. O mie de instrumente intr-unul singur, noul S Pen iti ofera niveluri impresionante de control.\r\nScrie, schiteaza sau deseneaza cele mai indraznete idei pentru a le transpune in realitate cu S Pen\r\nRezistenta crescuta\r\nCarcasa cu insertie Armor Aluminium protejeaza impotriva loviturilor si caderilor de tot felul. Este cel mai subtire, mai mare si mai rezistent Samsung Galaxy Tab S de pana acum si pondereaza durabilitatea impresionanta cu un design foarte usor si subtire.\r\nRezistenta crescuta\r\nSpatiu pentru a crea\r\n \r\nSpatiu pentru a crea\r\nGata pentru orice lucru demn de remarcat\r\nSamsung Notes este cel mai rapid mod de a nota toate ideile tale geniale de milioane de dolari intr-o clipa. Poate face tot: memorandumuri, schite, desene -- poate chiar sa transforme scrisul de mana in text pentru a-ti sustine fluxul ideilor.\r\nGata pentru orice lucru demn de remarcat\r\nClip Studio Paint va scoate in evidenta artistul din tine\r\nIti place sa desenezi sau sa pictezi? Clip Studio Paint a fost creat exact pentru oameni creativi ca tine. Cu o pensula naturala simti ca poti da viata celor mai fanteziste creatii ale tale.\r\n\r\nGalaxy Tab S8 Series si Galaxy S22 Series functioneaza ca o panza epica cu o paleta epica. Alege periile de pe telefon, pastrand in acelasi timp panza curata.\r\nClip Studio Paint va scoate in evidenta artistul din tine\r\nS Pen te transforma intr-un editor de precizie\r\nEsti gata sa creezi capodopera perfecta? S Pen si LumaFusion sunt aici pentru a te ajuta. Editeaza videoclipuri mai rapid si mai precis datorita celui mai mare salt in sensibilitatea de reactie a S Pen. LumaFusion ofera diferite instrumente de editare pentru a obtine editarea cinematica dorita.\r\nS Pen te transforma intr-un editor de precizie\r\nImpartaseste-ti ideile creative pe toate dispozitivele Galaxy intr-o clipa\r\nCu Quick Share, poti muta capodoperele printr-o atingere. Transfera cu usurinta fotografii uriase si fisiere video pe telefon sau pe PC.\r\nImpartaseste-ti ideile creative pe toate dispozitivele Galaxy intr-o clipa\r\nSpatiu pentru a pastra legatura\r\n \r\nSpatiu pentru a pastra legatura\r\nSpatiu pentru a face mai mult\r\n \r\nSpatiu pentru a face mai mult\r\nImparte ecranul. Fa fata cu brio zilei\r\nMarime. Pozitie. Si numar de ferestre. Tu detii controlul cu Multi Window. Aceasta inseamna ca poti cauta inspiratii decorative, poti schita planuri arhitecturale si poti discuta cu prietenul tau prin chat video -- toate in acelasi timp.\r\nImparte ecranul. Fa fata cu brio zilei\r\nSpatiu de joaca\r\n \r\nSpatiu de joaca\r\nUsor, dar plin de distractie\r\nReda in direct toate emisiunile sau filmele preferate in locul in care stai confortabil-- ei bine, chiar de oriunde doresti sa faci acest lucru. Ecranul vibrant si basul imbunatatit creeaza o experienta captivanta. Daca filmul nu te intereseaza, poti asculta si viziona muzica si videoclipurile preferate fara intrerupere, cu o perioada de proba de 4 luni de YouTube Premium inclusa in achizitia ta.\r\nUsor, dar plin de distractie\r\nPerformanta maxima oriunde\r\nObtine performante de calitatea consolei pe ecranul vast, oriunde doresti. Iar cu afisajul de 120Hz, totul functioneaza fara probleme pentru ca tu sa ajungi in clasament in cel mai scurt timp.\r\nPerformanta maxima oriunde\r\nCel mai rapid cip care a fost vreodata pe Samsung Galaxy\r\n\r\nBucura-te de viteze fulgeratoare pe diferitele jocuri pline de actiune si de software-ul de editare cu procesorul mobil de 4 nm -- Snapdragon(r) 8 Gen 1 Mobile Platform.\r\nCel mai rapid cip care a fost vreodata pe Samsung Galaxy\r\n \r\n\r\nConectare rapida la productivitate\r\nConectare rapida la productivitate\r\n\r\nGalaxy Tab S8 Series are Wi-Fi 6E. Ai cea mai rapida conexiune Wi-Fi pe tableta noastra pentru a-ti spori productivitatea. Partajeaza fisiere intre dispozitivele tale Galaxy cu viteze de pana la 2,4 Gbps.\r\n \r\n\r\nAccelereaza incarcarea\r\n\r\nBaterieul mare si inteligent iti permite sa realizezi cu usurinta maratoane de film, iar incarcatorul Super Fast de 45W incarca dispozitivul intr-o clipa.\r\nAccelereaza incarcarea\r\nO experienta neintrerupta\r\nBucura-te de o experienta continua pe toate dispozitivele tale Galaxy. One UI 4.1 iti permite sa accesezi aceleasi aplicatii intre Galaxy S22 Series si Galaxy Tab S8 Series. Chiar si ascultatul muzicii este facil cu Comutare automata cu Galaxy Buds. Galaxy Buds se va conecta automat de la Galaxy Tab S8 Series la Galaxy S22 Series pentru a comuta dispozitivele fara a pierde ritmul.', 'Tablet , samsung , galaxy , tab , s8 , gray', 8, 'images/tableta_samsung_galaxy_tab_s8_11_inch_128gb_8gb_wi-fi_gray_2.jpg', 'images/tableta_samsung_galaxy_tab_s8_11_inch_128gb_8gb_wi-fi_gray_6.jpg', '2023-07-02 22:49:21', ''),
(59, 11, 'Motorola VerveBuds 100', 40.00, 'images/146788_1.jpg', 'Casti True Wireless Motorola VerveBuds 100, Bluetooth, Negru\r\nCastile True Wireless VerveBuds 100 se concentreaza pe ceea ce conteaza cel mai mult - ramaneti conectat in miscare.\r\nButon multifunctional\r\nCastile True Wireless dispun de un buton multifunctional. Raspundeti la apeluri, reglati volumul, treceti peste melodii si multe altele cu functia inteligenta a butonului tactil de pe castile fara fir Bluetooth.\r\nButon multifunctional\r\nDurata de viata a bateriei de 14 ore\r\nCu un timp de redare de 5 ore a castilor si 9 ore cu carcasa portabila de incarcare, VerveBuds 100 va ofera un timp de joc nelimitat si cea mai buna experienta de ascultare.\r\nDurata de viata a bateriei de 14 ore\r\nRezistenta la transpiratie si apa IPX5\r\n\r\nCertificarea IPX5 va permite, de asemenea, sa va deplasati liber si confortabil, fara grija de a le deteriora. Puteti merge oriunde purtand VerveBuds 100, indiferent de vreme!\r\nRezistenta la transpiratie si apa IPX5\r\nDESIGN ERGONOMIC SI CALITATE SUPERIOARA A SUNETULUI\r\nDesign ergonomic si calitate superioara a sunetului\r\n\r\nVerveBuds 100 sunt casti concepute ergonomic pentru o potrivire cat mai confortabila. Trei marimi diferite de dopuri de silicon optimizeaza cea mai buna potrivire si experienta audio. VerveBuds 100 va ofera o calitate a sunetului HiFi si o reducere inteligenta a zgomotului pentru un sunet cu adevarat natural, autentic si performante de bas puternice.\r\nDimensiuni foarte usoare si compacte\r\n\r\nDesignul ultra-usor va ofera cea mai confortabila experienta de purtare. Carcasa portabila de incarcare are dimensiuni compacte, este convenabila de transportat oriunde in miscare, pentru a va oferi incarcare oriunde va duce viata.', 'motorola , headphone , vervebuds , 100 , negru', 9, 'images/146788_4.jpg', 'images/146788_5.jpg', '2023-07-02 22:50:45', ''),
(60, 11, 'Husa Motorola Moto G22, Verde', 21.00, 'images/226177647e0f3a145818.19617622.png', 'Detalii\r\nCompatibilitate: Compatibil cu Motorola Moto G22\r\nFinisajul acoperit cu silicon TPU ofera o prindere moale si confortabila, iar amprentele se sterg cu usurinta\r\nDurabila: Acoperita cu cauciuc siliconic, protejeaza impotriva socurilor, caderilor, zgarieturilor si loviturilor.\r\nAcces usor: decupaje precise de pe husa permit accesul usor la toate butoanele, porturile si camera foto\r\nLivrare\r\n1 x Husa compatibila cu Motorola Moto G22', 'husa , motorola , silicon , verde', 7, 'images/226183647e0f3b5a8314.63438347.png', 'images/226177647e0f3a145818.19617622.png', '2023-07-02 22:51:56', ''),
(61, 10, 'Sony MDREX110APB, Negru', 13.00, 'images/casti_sony_mdrex110apb_negru.jpg', 'Calitate a sunetului\r\nElemente intrauriculare comode, din silicon, cu fixare sigura.\r\nCalitate a sunetului\r\nDifuzoare de neodim de 9 mm pentru un sunet dinamic.\r\nDifuzoare de neodim de 9 mm pentru un sunet dinamic\r\nGama de frecventa de 5 - 24.000 Hz.\r\n>Gama de frecventa de 5 - 24.000 Hz\r\nCablu de tip Y de 1.2 m lungime.', 'sony, headphone , negru , casti', 9, 'images/casti_in-ear_sony_mdrex110apb_negru_2.jpg', 'images/casti_in-ear_sony_mdrex110apb_negru_1.jpg', '2023-07-02 22:52:58', ''),
(62, 12, 'OPPO A96, 128GB, 6GB Ram, Starry Black', 237.00, 'images/telefon_mobil_oppo_a96.jpg', 'Mai mare, mai rapid si in control\r\nO baterie de 5000 mAh iti ofera puterea de a prospera in viata. Ai nevoie de o reincarcare inainte de un apel video de durata? 33W SUPERVOOC iti ofera cu 50% mai multa putere in doar 26 de minute2. Simte puterea, fii in control.\r\nMai mare, mai rapid si in control\r\nReincarcari garantate. Incarcare optimizata pe timp de noapte\r\nDormi linistit cu protectia la incarcare pe timp de noapte cu AI. Nu se va supraincarca noaptea si permite bateriei sa-si pastreze capacitatea. Portul USB a fost supus, de asemenea, la 20.000 de teste de conectare, iar protectia sa anti-ardere asigura o reincarcare sigura si fiabila.\r\nReincarcari garantate\r\nEcran punch-hole de 90Hz cu o multitudine de culori\r\nBucura-te de imagini luminoase si captivante pe un ecran cu gama larga de culori NTSC de 96%. Vizioneaza filme si joaca jocuri captivante care functioneaza lin ca matasea datorita ratei de refresh de 90 Hz. Tehnologia Adaptive Refresh ofera, de asemenea, o performanta eleganta, economisind in acelasi timp energie. Acum te poti rasfata mai mult timp in viata digitala.\r\n\r\nDesign uimitor, estetica uluitoare. OPPO Glow Design\r\nDecorat cu un milion de particule ca de diamant la nivel nano, OPPO A96 uimeste si isi schimba culoarea din diferite unghiuri. De asemenea, are o constructie premium care va rezista testului timpului\r\nDesign uimitor, estetica uluitoare. OPPO Glow Design\r\nFerit de zgarieturi\r\nOPPO A96 este rezistent la urme sau amprente. Indiferent de activitatea pe care o faci, nu trebuie sa fii ingrijorat ca se va zgaria. Design premium, durabilitate premium.\r\nFerit de zgarieturi\r\nFaci fata oricarei situatii cu OPPO Enduring Quality\r\nOPPO ofera doar produse de incredere. OPPO A96 este rezistent la praf IP5X, rezistent la apa IPX45 si a trecut mii de teste de mediu, teste de cadere si multe altele. Acesta este un dispozitiv mobil care a fost creat pentru viata ta de zi cu zi si orice vine cu el.\r\nFaci fata oricarei situatii cu OPPO Enduring Quality\r\nProcesare mai facila a aplicatiilor si a amintirilor tale\r\nMemoria RAM/ROM si procesorul octa-core sunt construite pentru o fluiditate fara intarzieri. In timp ce extinderea suplimentara a memoriei RAM permite mai multor aplicatii sa ruleze la viteza fulgerului. Cu mai putine fragmente de memorie, poti colecta si mai multe amintiri dintr-o singura atingere.\r\nProcesare mai facila a aplicatiilor si a amintirilor tale\r\nExperienta de Divertisment Exceptionala\r\nBucura-te de stralucirea colorata a ecranului elegant al OPPO A96. Difuzoarele duble ofera o sarbatoare acustica in care sa te scufunzi. In timp ce rata mare de refresh si System Booster pot mentine distractia fluida si rapida.\r\nExperienta de Divertisment Exceptionala\r\nNu rata niciun cadru\r\nCamerele duble de inalta rezolutie surprind cu acuratete toate momentele tale memorabile, clar si luminos chiar si in conditii dificile.\r\nNu rata niciun cadru\r\nPortret Neon\r\nIti permite sa realizezi fotografii nocturne luminoase, cu estompare atmosferica.\r\nPortret Neon\r\nRetusare naturala AI\r\nRetusare naturala AI\r\n\r\nReflectii naturale, mai realiste, ale frumusetii tale personale.\r\nFill Light 360°\r\n\r\nIlumineaza noaptea si capteaza zambete mai stralucitoare.\r\nFill Light 360°\r\nColorOS 11.1\r\nAcum cu ColorOS actualizat 11.1 ColorOS este acum mai usor de utilizat si mai fluid.\r\nTraducere cu trei degete cu Google Lens\r\nTraducere cu trei degete cu Google Lens\r\n\r\nRealizezi capturi de ecran cu sabloane gratuite si traduci cu un singur clic.\r\nFlexDrop\r\n\r\nComutare mai facila intre mai multe aplicatii.', 'oppo, phone , dual-sim , black , negru ', 6, 'images/telefon_mobil_oppo_a96_ecran_starry_black.jpg', 'images/telefon_mobil_oppo_a96_spate_starry_black.jpg', '2023-07-02 22:54:26', ''),
(63, 8, 'Curea Watch 41mm, Sport Band', 50.00, 'images/41mm_product_red_sport_band_curea.jpg', 'Apple Watch Sport Band\r\n\r\nFabricata dintr-un fluoroelastomer personalizat de inalta performanta, Apple Watch Sport Band este durabila si puternica, dar surprinzator de moale. Materialul neted si dens se intinde elegant pe incheietura mainii si se simte confortabil pe piele. O inchidere inovatoare tip prindere asigura o potrivire sigura.', 'band , curea , red , rosu , watch , apple ', 7, 'images/41mm_product_red_sport_band_fata_ceas.jpg', 'images/41mm_product_red_sport_band_stanga_ceas.jpg', '2023-07-02 22:55:27', '');

-- --------------------------------------------------------

--
-- Structură tabel pentru tabel `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `pnumber` varchar(20) NOT NULL,
  `address` text NOT NULL,
  `registerdate` datetime NOT NULL DEFAULT current_timestamp(),
  `username` varchar(100) NOT NULL,
  `user_image` varchar(255) NOT NULL,
  `user_ip` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Eliminarea datelor din tabel `user`
--

INSERT INTO `user` (`user_id`, `first_name`, `last_name`, `email`, `password`, `pnumber`, `address`, `registerdate`, `username`, `user_image`, `user_ip`) VALUES
(3, 'Daniel-Stefan', 'Grosu', 'danycsov16@gmail.com', '$2y$10$r2sy9lY0bGu6Oh5e7euA.e9FwGGMar6tNFXj.qatKIXB7Lipk49lu', '0765544643', 'Nicolae iorga, Voluntari, Ilfov, Romania', '2023-06-30 01:47:11', 'danielgstefan', 'logo.png', '::1');

--
-- Indexuri pentru tabele eliminate
--

--
-- Indexuri pentru tabele `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexuri pentru tabele `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`brand_id`);

--
-- Indexuri pentru tabele `cart_details`
--
ALTER TABLE `cart_details`
  ADD PRIMARY KEY (`item_id`);

--
-- Indexuri pentru tabele `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexuri pentru tabele `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexuri pentru tabele `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`payment_id`);

--
-- Indexuri pentru tabele `pending`
--
ALTER TABLE `pending`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexuri pentru tabele `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`item_id`);

--
-- Indexuri pentru tabele `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT pentru tabele eliminate
--

--
-- AUTO_INCREMENT pentru tabele `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pentru tabele `brands`
--
ALTER TABLE `brands`
  MODIFY `brand_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT pentru tabele `categories`
--
ALTER TABLE `categories`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT pentru tabele `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT pentru tabele `payments`
--
ALTER TABLE `payments`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pentru tabele `pending`
--
ALTER TABLE `pending`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT pentru tabele `product`
--
ALTER TABLE `product`
  MODIFY `item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT pentru tabele `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
