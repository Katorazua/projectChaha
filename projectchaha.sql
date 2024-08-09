-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 07, 2024 at 10:16 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `projectchaha`
--

-- --------------------------------------------------------

--
-- Table structure for table `appointments`
--

CREATE TABLE `appointments` (
  `id` int(20) NOT NULL,
  `ap_pat_ailment` varchar(100) DEFAULT NULL,
  `ap_pat_name` varchar(20) DEFAULT NULL,
  `ap_pat_email` varchar(200) DEFAULT NULL,
  `ap_pat_phone` varchar(20) DEFAULT NULL,
  `doc_id` varchar(50) DEFAULT NULL,
  `ap_doc_name` varchar(20) DEFAULT NULL,
  `ap_doc_number` varchar(20) DEFAULT NULL,
  `doc_phone` varchar(20) DEFAULT NULL,
  `ap_service` varchar(200) DEFAULT NULL,
  `ap_date` varchar(11) DEFAULT NULL,
  `ap_status` varchar(20) DEFAULT NULL,
  `user_id` varchar(50) DEFAULT NULL,
  `ref_code` varchar(20) DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  `tx_id` varchar(200) DEFAULT NULL,
  `date_time` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `appointments`
--

INSERT INTO `appointments` (`id`, `ap_pat_ailment`, `ap_pat_name`, `ap_pat_email`, `ap_pat_phone`, `doc_id`, `ap_doc_name`, `ap_doc_number`, `doc_phone`, `ap_service`, `ap_date`, `ap_status`, `user_id`, `ref_code`, `status`, `tx_id`, `date_time`) VALUES
(20, 'Demo Ailment2', 'Adeke Susan', 'adekesuzzy@gmail.com', '09047948009', '9', 'Adeke Samuel', 'CEH/DOC/5KJC0', '09087646783', 'Demo Services', '2024-07-22', 'Approved', '34', '451XC', 'successful', NULL, NULL),
(21, 'Demo Ailment', 'King Susan', 'susan@gmail.com', '08047657890', '9', 'Adeke Samuel', 'CEH/DOC/5KJC0', '09087646783', 'Demo Services (NGN 200,000.00) ', '2024-07-22', 'Approved', '35', 'pcgwfapt-10789704', 'successful', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(255) UNSIGNED NOT NULL,
  `admin_id` bigint(255) UNSIGNED DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `description` varchar(50) NOT NULL,
  `date_time` timestamp NOT NULL DEFAULT current_timestamp(),
  `hps` varchar(3) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `admin_id`, `title`, `description`, `date_time`, `hps`) VALUES
(1, 4, 'Demo category', 'This is Cetegory description', '2024-03-12 07:28:16', NULL),
(3, 4, 'Product category demo', 'This is product category demo description', '2024-03-20 03:56:27', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE `contact` (
  `id` int(20) NOT NULL,
  `fullname` varchar(200) DEFAULT NULL,
  `email` varchar(200) DEFAULT NULL,
  `subject` varchar(200) DEFAULT NULL,
  `message` text DEFAULT NULL,
  `hps` varchar(5) DEFAULT NULL,
  `date_time` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contact`
--

INSERT INTO `contact` (`id`, `fullname`, `email`, `subject`, `message`, `hps`, `date_time`) VALUES
(1, 'kator Azua', 'kator@gmail.com', 'Ahelp request', 'Help us give the best helth care services by sending in feedback', NULL, '2024-06-01 07:54:23'),
(8, 'John', 'john@gmail.com', 'Learnig how to code', 'Learnig how to code ON Alpha code institute', NULL, '2024-06-01 12:20:05'),
(10, 'bmmn', 'mn@gmail.com', 'lk', 'uyfu', NULL, '2024-06-20 15:48:18'),
(11, 'sussan', 'susan@gmail.com', 'Learnig how to code', 'i need help on how to go about this app', 'CEH', '2024-07-08 22:10:21'),
(12, 'admin', 'john@gmail.com', 'Math', 'asedr', 'CEH', '2024-08-02 18:06:12'),
(13, '', 'adekemsontersamuel@gmail.com', '', '', 'CEH', '2024-08-02 18:06:49'),
(15, 'admin', 'kator47@gmail.com', 'BTech', 'fuyttoi', 'CEH', '2024-08-02 18:36:49');

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE `department` (
  `id` int(20) NOT NULL,
  `admin_id` bigint(255) UNSIGNED DEFAULT NULL,
  `name` varchar(50) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `date_time` timestamp(6) NOT NULL DEFAULT current_timestamp(6) ON UPDATE current_timestamp(6)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`id`, `admin_id`, `name`, `description`, `date_time`) VALUES
(1, 4, 'Gynacology', 'This is Department description', '2024-03-23 03:02:55.080867'),
(3, NULL, 'Department Demo', 'Description Demo', '2024-04-20 01:37:12.782757');

-- --------------------------------------------------------

--
-- Table structure for table `doctors`
--

CREATE TABLE `doctors` (
  `id` bigint(255) UNSIGNED NOT NULL,
  `admin_id` bigint(255) UNSIGNED DEFAULT NULL,
  `firstname` varchar(50) DEFAULT NULL,
  `lastname` varchar(50) DEFAULT NULL,
  `doc_number` varchar(200) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `role` varchar(20) DEFAULT NULL,
  `department` varchar(50) NOT NULL,
  `company_name` varchar(50) DEFAULT NULL,
  `job` varchar(50) DEFAULT NULL,
  `avatar` varchar(255) DEFAULT NULL,
  `doc_about` text DEFAULT NULL,
  `doc_gender` varchar(8) DEFAULT NULL,
  `doc_addr` varchar(200) DEFAULT NULL,
  `doc_city` varchar(200) DEFAULT NULL,
  `doc_phone` varchar(20) DEFAULT NULL,
  `facebook` varchar(200) DEFAULT NULL,
  `twitter` varchar(200) DEFAULT NULL,
  `instagram` varchar(200) DEFAULT NULL,
  `linkedin` varchar(200) DEFAULT NULL,
  `relationship` varchar(20) DEFAULT NULL,
  `reset_token_hash` varchar(64) DEFAULT NULL,
  `reset_token_expiration` datetime DEFAULT NULL,
  `status` varchar(11) DEFAULT NULL,
  `date_time` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `doctors`
--

INSERT INTO `doctors` (`id`, `admin_id`, `firstname`, `lastname`, `doc_number`, `email`, `password`, `role`, `department`, `company_name`, `job`, `avatar`, `doc_about`, `doc_gender`, `doc_addr`, `doc_city`, `doc_phone`, `facebook`, `twitter`, `instagram`, `linkedin`, `relationship`, `reset_token_hash`, `reset_token_expiration`, `status`, `date_time`) VALUES
(7, 4, 'kator', 'Azua', 'CEH/DOC/E14KH', 'katorazua674@gmail.com', '$2y$10$pR5hDgdO7EQOWN7j.O/YrOeRPeU4LUPkdR2.Ozl0tfQFwBAiPFq52', 'Medical_Doctor', 'Not Assigned', 'CEH', 'Doctor', '1720286280katorazua.jpg', '', 'Male', 'AlphaRest.com', 'Makurdi, Benue State. Nigeria', '09087654328', 'https//:facebook.com/', 'https//:twitter.com/', '', '', 'Single', NULL, NULL, 'Offline', '2024-05-24 00:49:31'),
(9, 4, 'Adeke', 'Samuel', 'CEH/DOC/5KJC0', 'adekemsontersamuel@gmail.com', '$2y$10$YT.Q3splC/0gMCtHLe9tP.aa.KZiMT2gF2X0UcUAUO0O1fIjc2he6', 'Medical_Doctor', 'Not Assigned', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Active now', '2024-06-30 23:11:16');

-- --------------------------------------------------------

--
-- Table structure for table `doc_transfer`
--

CREATE TABLE `doc_transfer` (
  `id` int(20) NOT NULL,
  `admin_id` bigint(255) UNSIGNED DEFAULT NULL,
  `firstname` varchar(20) DEFAULT NULL,
  `lastname` varchar(20) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `doc_number` varchar(15) DEFAULT NULL,
  `department` varchar(50) DEFAULT NULL,
  `ref_hospital` varchar(255) DEFAULT NULL,
  `date_transfer` varchar(20) DEFAULT NULL,
  `status` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `doc_transfer`
--

INSERT INTO `doc_transfer` (`id`, `admin_id`, `firstname`, `lastname`, `email`, `doc_number`, `department`, `ref_hospital`, `date_transfer`, `status`) VALUES
(1, 4, 'kator', 'Azua', '', 'CEH123DK', 'Gynacology', 'Chaha Eye Hospital, KM5 Markurdi Road.', '2024-03-26', 'Transfered');

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `id` bigint(255) NOT NULL,
  `admin_id` bigint(255) UNSIGNED NOT NULL,
  `firstname` varchar(20) DEFAULT NULL,
  `lastname` varchar(20) DEFAULT NULL,
  `emp_number` varchar(20) DEFAULT NULL,
  `gender` varchar(10) DEFAULT NULL,
  `age` varchar(3) DEFAULT NULL,
  `department` varchar(50) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `city` varchar(100) DEFAULT NULL,
  `company_name` varchar(100) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  `avatar` varchar(200) DEFAULT NULL,
  `date_time` timestamp(6) NOT NULL DEFAULT current_timestamp(6) ON UPDATE current_timestamp(6),
  `role` varchar(20) DEFAULT NULL,
  `emp_addr` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`id`, `admin_id`, `firstname`, `lastname`, `emp_number`, `gender`, `age`, `department`, `email`, `phone`, `city`, `company_name`, `password`, `status`, `avatar`, `date_time`, `role`, `emp_addr`) VALUES
(3, 4, 'James ', 'Susan', 'CEH123JS', 'Female', '32', 'Gynacology', 'james@gmail.com', '0987365720', 'Makurdi, Benue State, Nigeria', 'Chaha Eye Hospital', NULL, 'Active Staff', '1711080172testimonials-3.jpg', '2024-05-24 09:08:30.284295', 'Nurse', 'AlphaRest, Y2 NG');

-- --------------------------------------------------------

--
-- Table structure for table `employee_transfer`
--

CREATE TABLE `employee_transfer` (
  `id` int(20) NOT NULL,
  `admin_id` bigint(255) UNSIGNED DEFAULT NULL,
  `firstname` varchar(20) DEFAULT NULL,
  `lastname` varchar(20) DEFAULT NULL,
  `emp_number` varchar(20) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `ref_company` varchar(50) DEFAULT NULL,
  `transfer_date` varchar(11) DEFAULT NULL,
  `status` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `employee_transfer`
--

INSERT INTO `employee_transfer` (`id`, `admin_id`, `firstname`, `lastname`, `emp_number`, `phone`, `email`, `ref_company`, `transfer_date`, `status`) VALUES
(1, 4, 'James ', 'Susan', 'CEH123JS', '0987365720', 'james@gmail.com', 'Chaha Eye Hospital', '2024-03-27', 'Transfered');

-- --------------------------------------------------------

--
-- Table structure for table `equipments`
--

CREATE TABLE `equipments` (
  `id` int(20) NOT NULL,
  `admin_id` bigint(255) UNSIGNED DEFAULT NULL,
  `eqp_code` varchar(10) DEFAULT NULL,
  `eqp_name` varchar(200) DEFAULT NULL,
  `eqp_vendor` varchar(200) DEFAULT NULL,
  `eqp_desc` longtext DEFAULT NULL,
  `eqp_dept` varchar(50) DEFAULT NULL,
  `eqp_status` varchar(20) DEFAULT NULL,
  `eqp_qty` varchar(200) DEFAULT NULL,
  `date_time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `equipments`
--

INSERT INTO `equipments` (`id`, `admin_id`, `eqp_code`, `eqp_name`, `eqp_vendor`, `eqp_desc`, `eqp_dept`, `eqp_status`, `eqp_qty`, `date_time`) VALUES
(1, 4, '69780542', 'Demo eqp name', 'Eye-cap Pharmacy company', 'Demo Equipment Description\r\n1.THIS IS HEADING ONE DEC. 15-2017. Sunt est soluta temporibus accusantium neque nam maiores cumque temporibus. Tempora libero non est unde veniam est qui dolor. Ut sunt iure rerum quae quisquam autem eveniet perspiciatis odit. Fuga sequi sed ea saepe at unde. 2.THIS IS HEADING TWO JAN, 2-2024. Sunt est soluta temporibus accusantium neque nam maiores cumque temporibus. Tempora libero non est unde veniam est qui dolor. Ut sunt iure rerum quae quisquam autem eveniet perspiciatis odit. Fuga sequi sed ea saepe at unde.', 'Gynacology', 'Not Functioning', '25', '2024-03-20 23:31:22');

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id` int(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `body` text NOT NULL,
  `thumbnail` varchar(255) NOT NULL,
  `category_id` int(255) UNSIGNED DEFAULT NULL,
  `author_id` bigint(255) UNSIGNED NOT NULL,
  `is_featured` tinyint(1) NOT NULL,
  `date_time` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `title`, `body`, `thumbnail`, `category_id`, `author_id`, `is_featured`, `date_time`) VALUES
(1, 'Demo Event Title ', 'Lorem ipsum, dolor sit amet consectetur adipisicing elit. Tempora illum debitis doloribus harum labore laborum rem quaerat eos quidem, magnam natus, non iusto eveniet itaque ipsa illo vero quos rerum?&lt;/span&gt;&lt;span&gt;Minus incidunt laborum deserunt atque dolore veniam, ex hic. Sapiente sit quas saepe ipsam? Doloribus tempore corrupti quasi repudiandae natus accusantium officiis possimus, laudantium omnis quaerat. Itaque dolorum reiciendis porro.&lt;/span&gt;&lt;span&gt;Nulla modi vel error incidunt ab est quos blanditiis temporibus at molestiae minima obcaecati, atque aperiam non repellat dolores? Asperiores voluptatum quos inventore aperiam. Autem ut minima odit placeat est!&lt;/span&gt;&lt;span&gt;Facere ipsam, iure nesciunt aliquid doloremque veritatis ut libero blanditiis modi enim aperiam voluptatibus ducimus nulla, minima vitae debitis sint culpa doloribus neque distinctio labore exercitationem! Earum fugiat reiciendis tempora?&lt;/span&gt;&lt;span&gt;Rerum, quasi laborum rem eum omnis debitis provident ad quae temporibus ipsum laboriosam? Vero obcaecati, dolores aspernatur dolor nobis ad excepturi mollitia nihil numquam sapiente, consequatur explicabo, neque magni aliquam.&lt;/span&gt;&lt;span&gt;Ratione velit dolorum deleniti, nulla id impedit, quaerat, a asperiores totam repellendus quibusdam. Nihil, deleniti? Accusamus dolores quo laboriosam corrupti soluta quaerat, fuga aspernatur consectetur expedita est deserunt exercitationem perspiciatis.&lt;/span&gt;&lt;span&gt;Tenetur, aspernatur non magni dolor harum nostrum explicabo esse unde ratione recusandae ipsum laborum laboriosam voluptatem. Itaque maiores temporibus voluptate, esse dolores, commodi nobis quibusdam consequuntur aspernatur magnam consequatur vitae!&lt;/span&gt;&lt;span&gt;Rerum maiores minus tempora exercitationem pariatur nulla totam saepe modi est sed? Non perspiciatis sunt laudantium enim, reiciendis assumenda magni, eveniet et consectetur animi facere autem in, suscipit odit distinctio!&lt;/span&gt;&lt;span&gt;Amet eos facilis praesentium optio voluptatem doloribus quidem nesciunt cum earum consequatur. Explicabo ex nisi libero fuga iusto natus dolorem voluptatum delectus modi dolor tempora provident, labore nostrum eius earum.&lt;/span&gt;&lt;span&gt;Non assumenda eum suscipit incidunt error praesentium facere ipsam nemo possimus ea corporis quos dolore iusto, natus libero unde! Tempora soluta maxime iste nostrum ad, eius quibusdam obcaecati cumque fugit?&lt;/span&gt;&lt;span&gt;Consectetur deleniti dignissimos nemo quis officia dolorem perspiciatis tempora ea, pariatur ipsa earum vel laudantium dolorum, ratione magnam repudiandae assumenda quam corrupti laboriosam cumque dolor quia voluptatem! Iure, sit molestias?&lt;/span&gt;&lt;span&gt;Doloribus eum non optio incidunt fuga? Iusto, maiores repellat amet porro in, adipisci quas nisi quisquam ad vel sed debitis, quis aspernatur corporis. Sed possimus itaque, delectus atque vero voluptas.&lt;/span&gt;&lt;span&gt;Libero, corporis! Iusto atque dolorem dolores laudantium eaque tenetur nulla sed cum. Quasi delectus deserunt officiis repellat in voluptatum maiores, ex inventore laborum, error, aut aliquam dolore tempore debitis quidem.&lt;/span&gt;&lt;span&gt;Rerum praesentium aliquam explicabo id nostrum corrupti provident eaque, facilis incidunt perferendis cum expedita, placeat soluta optio officiis, doloremque eligendi? Eligendi tenetur explicabo perspiciatis. Alias omnis tempora et eius saepe!&lt;/span&gt;&lt;span&gt;Quas esse amet quibusdam facilis iste voluptatum nam placeat soluta, veniam molestiae ullam enim necessitatibus, architecto at, adipisci eveniet reiciendis. Temporibus voluptatum delectus tenetur rem eligendi laboriosam amet provident quis.&lt;/span&gt;&lt;span&gt;Nobis est sequi alias voluptate itaque perferendis consectetur cum tenetur, reprehenderit illo provident! Alias ad rem, at sit corrupti temporibus voluptates dolor rerum autem aut qui cumque libero laboriosam veritatis.&lt;/span&gt;&lt;span&gt;Eius itaque esse non nihil est doloribus, velit expedita nisi sunt at? Voluptatum assumenda debitis illum placeat? Deleniti temporibus labore unde reprehenderit velit porro officiis molestias praesentium! Voluptatibus, modi quam!&lt;/span&gt;&lt;span&gt;Eius, ex cupiditate? Magnam modi velit odio beatae iure amet illo ab atque minima totam. Ipsum, vel, aliquam quam ipsam odit tempore suscipit ex quae vero, doloribus corporis! Sed, excepturi!&lt;/span&gt;&lt;span&gt;Vitae, temporibus nulla facilis ipsum repellendus maxime, fugiat eius corrupti id deleniti hic dicta inventore, in molestiae veniam illum perferendis! Ex alias culpa minus. A incidunt accusantium in eos laborum?&lt;/span&gt;&lt;span&gt;Ab, saepe obcaecati amet sit atque laboriosam rem dignissimos odit cum, molestiae dicta itaque repellat! Quod, quibusdam officia aperiam doloremque a placeat explicabo nostrum aliquam. Eum sit inventore maiores ullam.&lt;/span&gt;&lt;span&gt;Inventore explicabo iste maxime nulla debitis consequatur quibusdam est fugiat ducimus architecto quis nobis itaque at sunt quo ipsam facilis praesentium laborum, doloremque, amet, excepturi hic a id. Voluptatem, molestias!&lt;/span&gt;&lt;span&gt;Aliquid enim non saepe minus sequi. Reiciendis tempore facere non illum earum culpa fugiat provident laudantium velit a, beatae vel adipisci quasi temporibus voluptates ad quas magnam mollitia dicta ullam?&lt;/span&gt;&lt;span&gt;Libero, impedit corporis veniam labore nam sint tenetur itaque earum, vel debitis dolorem voluptates sequi beatae voluptatum! Neque esse beatae quis blanditiis? Voluptatum nobis aut ea aliquid consequatur non ab?&lt;/span&gt;&lt;span&gt;Facilis quidem omnis iure repellat asperiores sit dolore nulla expedita voluptates velit magnam quod, nihil, suscipit ut non molestias ullam? Sed omnis obcaecati ipsa repudiandae ipsam, ullam provident odio possimus!&lt;/span&gt;&lt;span&gt;Itaque ab consequuntur error aperiam, odio accusantium voluptatem dignissimos similique exercitationem eum reprehenderit quae dolorem totam quibusdam. Nesciunt molestiae assumenda quia perferendis asperiores corrupti inventore reiciendis eaque? Consectetur, maxime nobis?&lt;/span&gt;&lt;span&gt;Blanditiis, sunt dignissimos, culpa voluptatum totam tenetur soluta expedita ratione maxime consectetur odio tempora maiores laudantium modi. Numquam aperiam expedita architecto reprehenderit esse veritatis, omnis saepe ut perferendis eveniet est.&lt;/span&gt;&lt;span&gt;Perspiciatis ab tempora quam quis saepe a vitae. Eius corporis perferendis quis vel vero repellendus unde, sunt vitae at, blanditiis officia, sed veritatis. Porro accusamus recusandae itaque et ad eius!&lt;/span&gt;&lt;span&gt;At quasi aut, totam dolorum neque delectus deserunt, nisi sequi porro odio deleniti fugit quo quis. Placeat quibusdam quisquam et veritatis odit, sint temporibus, modi natus nulla, dolore commodi voluptate.&lt;/span&gt;&lt;span&gt;Voluptatibus, rerum suscipit! Eos, beatae eaque fugit modi voluptate ut earum soluta porro maxime quasi id optio, voluptatem quis, incidunt impedit non cupiditate. Deserunt, enim facere soluta porro repudiandae quisquam?&lt;/span&gt;&lt;span&gt;Doloribus ex quis quam? Itaque nostrum ea maxime reprehenderit omnis, debitis quod pariatur ipsum assumenda corrupti ad veniam fugit accusantium beatae cumque, mollitia quidem? Ipsam perferendis vel animi enim magni.&lt;/span&gt;&lt;span&gt;Beatae ad impedit quidem placeat expedita quo, obcaecati excepturi, veritatis harum numquam laudantium architecto? Dolor odio sint voluptatibus, porro beatae nobis, veniam incidunt assumenda repellat dolorem dignissimos voluptas ad eum.&lt;/span&gt;&lt;span&gt;Beatae dicta at corrupti architecto minus expedita repellendus eveniet ex sed aperiam autem modi error deleniti est, quas laboriosam reprehenderit nulla nostrum voluptates dolorem? Quis dolores doloremque incidunt cupiditate iusto.&lt;/span&gt;&lt;span&gt;Quo, non id! Hic omnis, numquam minus deserunt exercitationem magni ducimus libero illo distinctio at. Repudiandae nobis maiores laudantium nostrum omnis voluptates nihil vero, non, provident nemo dolore, reiciendis quae?&lt;/span&gt;&lt;span&gt;At asperiores maiores cum numquam molestiae, libero dicta reiciendis quo non quae laudantium modi sint amet animi veniam mollitia distinctio delectus doloremque facere deserunt odio rerum, sed accusamus earum! Aut?&lt;/span&gt;&lt;span&gt;Quos quod quibusdam et sed nisi? Fugiat debitis nulla sed necessitatibus et voluptatem vitae ut esse deserunt dicta adipisci veritatis atque enim saepe, iusto molestias veniam iure alias aut ducimus.&lt;/span&gt;&lt;span&gt;Corrupti aliquam quidem ratione, earum quam enim ipsum, veniam nemo repellat voluptates excepturi explicabo itaque alias officia maiores error temporibus maxime ipsam quisquam iure? Ducimus quam eaque deleniti quibusdam dignissimos?&lt;/span&gt;&lt;span&gt;Quae exercitationem ipsa expedita quas saepe incidunt ullam ', '1710486164about.jpg', 1, 4, 1, '2024-03-15 04:40:08');

-- --------------------------------------------------------

--
-- Table structure for table `forgetpass`
--

CREATE TABLE `forgetpass` (
  `id` int(20) NOT NULL,
  `firstname` varchar(20) NOT NULL,
  `lastname` varchar(20) NOT NULL,
  `username` varchar(20) NOT NULL,
  `email` varchar(200) NOT NULL,
  `password` varchar(255) NOT NULL,
  `avatar` varchar(255) NOT NULL,
  `rest_token_hash` varchar(64) DEFAULT NULL,
  `reset_token_expiration` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `role` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `forgetpass`
--

INSERT INTO `forgetpass` (`id`, `firstname`, `lastname`, `username`, `email`, `password`, `avatar`, `rest_token_hash`, `reset_token_expiration`, `role`) VALUES
(1, 'kator', 'Azua', 'kator', 'katorazua674@gmail.com', '$2y$10$i6AEn/qk0AqdCklRVNlkaesw4FPF/oebmjAS7TAm.SRcY5z8hAO0K', '1716468575user.jpg', '1fdd88ecb83b6d0c41d21d24da8fa175876a56d8ba42a4e608698c8b811daaf7', '2024-06-21 16:41:42', 'super');

-- --------------------------------------------------------

--
-- Table structure for table `introduction`
--

CREATE TABLE `introduction` (
  `id` int(255) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `video` varchar(255) NOT NULL,
  `date_time` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `introduction`
--

INSERT INTO `introduction` (`id`, `title`, `video`, `date_time`) VALUES
(1, 'Find Location', '1720475720VID-20240108-WA0005.mp4', '2024-01-16 22:02:37');

-- --------------------------------------------------------

--
-- Table structure for table `laboratory`
--

CREATE TABLE `laboratory` (
  `id` bigint(20) NOT NULL,
  `admin_id` bigint(255) UNSIGNED DEFAULT NULL,
  `doc_id` bigint(255) UNSIGNED DEFAULT NULL,
  `lab_pat_name` varchar(20) DEFAULT NULL,
  `lab_pat_age` varchar(3) DEFAULT NULL,
  `lab_pat_gender` varchar(10) DEFAULT NULL,
  `lab_pat_ailment` varchar(200) DEFAULT NULL,
  `lab_pat_number` varchar(10) DEFAULT NULL,
  `lab_pat_unit` varchar(50) DEFAULT NULL,
  `lab_pat_tests` longtext DEFAULT NULL,
  `lab_pat_results` longtext DEFAULT NULL,
  `lab_number` varchar(20) DEFAULT NULL,
  `date_time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `laboratory`
--

INSERT INTO `laboratory` (`id`, `admin_id`, `doc_id`, `lab_pat_name`, `lab_pat_age`, `lab_pat_gender`, `lab_pat_ailment`, `lab_pat_number`, `lab_pat_unit`, `lab_pat_tests`, `lab_pat_results`, `lab_number`, `date_time`) VALUES
(1, 4, NULL, 'John Doe', '4', 'Female', 'Eye defect', 'CEH123', 'NHIS', 'Sunt est soluta temporibus accusantium neque nam maiores cumque temporibus. Tempora libero non est unde veniam est qui dolor. Ut sunt iure rerum quae quisquam autem eveniet perspiciatis odit. Fuga sequi sed ea saepe at unde.&lt;/Sunt est soluta temporibus accusantium neque nam maiores cumque temporibus. Tempora libero non est unde veniam est qui dolor. Ut sunt iure rerum quae quisquam autem eveniet perspiciatis odit. Fuga sequi sed ea saepe at unde.&lt;/Sunt est soluta temporibus accusantium neque nam maiores cumque temporibus. Tempora libero non est unde veniam est qui dolor. Ut sunt iure rerum quae quisquam autem eveniet perspiciatis odit. Fuga sequi sed ea saepe at unde.&lt;/Sunt est soluta temporibus accusantium neque nam maiores cumque temporibus. Tempora libero non est unde veniam est qui dolor. Ut sunt iure rerum quae quisquam autem eveniet perspiciatis odit. Fuga sequi sed ea saepe at unde.&lt;/Sunt est soluta temporibus accusantium neque nam maiores cumque temporibus. Tempora libero non est unde veniam est qui dolor. Ut sunt iure rerum quae quisquam autem eveniet perspiciatis odit. Fuga sequi sed ea saepe at unde.&lt;/Sunt est soluta temporibus accusantium neque nam maiores cumque temporibus. Tempora libero non est unde veniam est qui dolor. Ut sunt iure rerum quae quisquam autem eveniet perspiciatis odit. Fuga sequi sed ea saepe at unde.&lt;/Sunt est soluta temporibus accusantium neque nam maiores cumque temporibus. Tempora libero non est unde veniam est qui dolor. Ut sunt iure rerum quae quisquam autem eveniet perspiciatis odit. Fuga sequi sed ea saepe at unde.&lt;/', '&lt;br /&gt;\r\n&lt;b&gt;Warning&lt;/b&gt;:  Undefined variable $lab_pat_results in &lt;b&gt;C:xampphtdocsprojectChahasuperAdminadd-patient-lab-result.php&lt;/b&gt; on line &lt;b&gt;142&lt;/b&gt;&lt;br /&gt;\r\nSunt est soluta temporibus accusantium neque nam maiores cumque temporibus. Tempora libero non est unde veniam est qui dolor. Ut sunt iure rerum quae quisquam autem eveniet perspiciatis odit. Fuga sequi sed ea saepe at unde.&lt;/Sunt est soluta temporibus accusantium neque nam maiores cumque temporibus. Tempora libero non est unde veniam est qui dolor. Ut sunt iure rerum quae quisquam autem eveniet perspiciatis odit. Fuga sequi sed ea saepe at unde.&lt;/Sunt est soluta temporibus accusantium neque nam maiores cumque temporibus. Tempora libero non est unde veniam est qui dolor. Ut sunt iure rerum quae quisquam autem eveniet perspiciatis odit. Fuga sequi sed ea saepe at unde.&lt;/Sunt est soluta temporibus accusantium neque nam maiores cumque temporibus. Tempora libero non est unde veniam est qui dolor. Ut sunt iure rerum quae quisquam autem eveniet perspiciatis odit. Fuga sequi sed ea saepe at unde.&lt;/Sunt est soluta temporibus accusantium neque nam maiores cumque temporibus. Tempora libero non est unde veniam est qui dolor. Ut sunt iure rerum quae quisquam autem eveniet perspiciatis odit. Fuga sequi sed ea saepe at unde.&lt;/Sunt est soluta temporibus accusantium neque nam maiores cumque temporibus. Tempora libero non est unde veniam est qui dolor. Ut sunt iure rerum quae quisquam autem eveniet perspiciatis odit. Fuga sequi sed ea saepe at unde.&lt;/Sunt est soluta temporibus accusantium neque nam maiores cumque temporibus. Tempora libero non est unde veniam est qui dolor. Ut sunt iure rerum quae quisquam autem eveniet perspiciatis odit. Fuga sequi sed ea saepe at unde.&lt;/', 'S3BVG8', '2024-03-20 20:55:35');

-- --------------------------------------------------------

--
-- Table structure for table `medical_records`
--

CREATE TABLE `medical_records` (
  `id` bigint(20) NOT NULL,
  `admin_id` bigint(255) UNSIGNED DEFAULT NULL,
  `doc_id` bigint(255) UNSIGNED DEFAULT NULL,
  `mdr_number` varchar(6) DEFAULT NULL,
  `mdr_pat_name` varchar(20) DEFAULT NULL,
  `mdr_pat_adr` varchar(50) DEFAULT NULL,
  `mdr_pat_age` varchar(3) DEFAULT NULL,
  `mdr_pat_gender` varchar(10) DEFAULT NULL,
  `mdr_pat_ailment` varchar(20) DEFAULT NULL,
  `mdr_pat_number` varchar(10) DEFAULT NULL,
  `mdr_pat_btemp` varchar(20) DEFAULT NULL,
  `mdr_pat_hrp` varchar(20) DEFAULT NULL,
  `mdr_pat_rt` varchar(20) DEFAULT NULL,
  `mdr_pat_bp` varchar(20) DEFAULT NULL,
  `mdr_pat_prescr` longtext DEFAULT NULL,
  `date_time` timestamp(4) NOT NULL DEFAULT current_timestamp(4) ON UPDATE current_timestamp(4)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `medical_records`
--

INSERT INTO `medical_records` (`id`, `admin_id`, `doc_id`, `mdr_number`, `mdr_pat_name`, `mdr_pat_adr`, `mdr_pat_age`, `mdr_pat_gender`, `mdr_pat_ailment`, `mdr_pat_number`, `mdr_pat_btemp`, `mdr_pat_hrp`, `mdr_pat_rt`, `mdr_pat_bp`, `mdr_pat_prescr`, `date_time`) VALUES
(1, 4, NULL, 'PY87GC', 'John Doe', 'Opp. Nigeria Brewery KM5 Gboko Road', '4', 'Female', 'Eye defect', 'CEH123', '37 deegre c.', '66 bit/min', '120', '125', '1.THIS IS HEADING ONE DEC. 15-2017.\r\nSunt est soluta temporibus accusantium neque nam maiores cumque temporibus. Tempora libero non est unde veniam est qui dolor. Ut sunt iure rerum quae quisquam autem eveniet perspiciatis odit. Fuga sequi sed ea saepe at unde.\r\n\r\n2.THIS IS HEADING TWO JAN, 2-2024.\r\nSunt est soluta temporibus accusantium neque nam maiores cumque temporibus. Tempora libero non est unde veniam est qui dolor. Ut sunt iure rerum quae quisquam autem eveniet perspiciatis odit. Fuga sequi sed ea saepe at unde.\r\n\r\n3.THIS IS HEADING THREE NOV. 4-1998.\r\nSunt est soluta temporibus accusantium neque nam maiores cumque temporibus. Tempora libero non est unde veniam est qui dolor. Ut sunt iure rerum quae quisquam autem eveniet perspiciatis odit. Fuga sequi sed ea saepe at unde.\r\n\r\n4.THIS IS HEADING FOUR JAN. 3-2000.\r\nSunt est soluta temporibus accusantium neque nam maiores cumque temporibus. Tempora libero non est unde veniam est qui dolor. Ut sunt iure rerum quae quisquam autem eveniet perspiciatis odit. Fuga sequi sed ea saepe at unde.', '2024-03-20 18:19:24.2787');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int(200) NOT NULL,
  `incoming_msg_id` varchar(20) NOT NULL,
  `outgoing_msg_id` varchar(20) NOT NULL,
  `message` longtext NOT NULL,
  `date_time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `incoming_msg_id`, `outgoing_msg_id`, `message`, `date_time`) VALUES
(2, '7', '34', 'hi', '2024-06-07 22:44:44'),
(3, '34', '7', 'hello', '2024-06-07 23:31:11'),
(4, '34', '7', 'how are you feeling to day', '2024-06-07 23:48:42'),
(5, '7', '34', 'i am good', '2024-06-07 23:52:03'),
(6, '34', '7', 'From your medical history....', '2024-06-07 23:56:24'),
(7, '34', '7', 'i will set a meeting', '2024-06-08 00:07:34'),
(8, '7', '34', 'ok Doc', '2024-06-08 00:44:17'),
(9, '7', '34', 'i will give you a call', '2024-06-08 00:51:48'),
(10, '7', '34', 'also...', '2024-06-08 00:59:03'),
(11, '34', '7', 'yes', '2024-06-08 01:00:48'),
(12, '34', '7', 'yes', '2024-06-08 01:29:18'),
(13, '34', '7', 'yes', '2024-06-08 01:29:47'),
(14, '34', '7', 'yes', '2024-06-08 01:31:01'),
(15, '34', '7', 'yes', '2024-06-08 01:36:17'),
(16, '34', '7', 'yes', '2024-06-08 01:39:31'),
(17, '34', '7', 'yes', '2024-06-08 01:39:57'),
(18, '7', '34', 'ok', '2024-06-08 01:44:31'),
(19, '7', '34', 'ok', '2024-06-08 01:44:47'),
(20, '34', '7', 'go on', '2024-06-08 01:50:34'),
(21, '7', '34', 'ok', '2024-06-08 01:51:33'),
(22, '7', '34', 'ok', '2024-06-08 01:52:30'),
(23, '7', '34', 'mmmm', '2024-06-08 01:52:54'),
(24, '7', '34', 'mmmm', '2024-06-08 01:53:10'),
(25, '7', '', 'test only', '2024-06-08 02:04:20'),
(26, '34', '7', 'go on', '2024-06-08 02:51:54'),
(27, '34', '7', 'go on', '2024-06-08 03:05:21'),
(28, '34', '7', 'go on', '2024-06-08 03:08:18'),
(29, '34', '7', 'go on', '2024-06-08 03:09:05'),
(30, '7', '', 'testing2', '2024-06-08 03:13:01'),
(31, '7', '34', 'testing2', '2024-06-08 03:25:11'),
(32, '7', '34', 'testing2', '2024-06-08 03:25:24'),
(33, '7', '34', 'testing2', '2024-06-08 03:35:52'),
(34, '7', '34', 'testing2', '2024-06-08 03:49:38'),
(35, '34', '7', 'hi', '2024-06-08 03:51:22'),
(36, '34', '7', 'hi', '2024-06-08 03:51:52'),
(37, '34', '7', 'hello', '2024-06-08 03:52:55'),
(38, '34', '7', 'hello', '2024-06-08 03:57:14'),
(39, '7', '34', 'ok', '2024-06-08 03:57:48'),
(40, '34', '7', 'yes', '2024-06-08 03:58:53'),
(41, '7', '34', 'LETs try agian', '2024-06-08 04:03:34'),
(42, '34', '7', 'ok', '2024-06-08 04:05:51'),
(43, '7', '34', 'hi', '2024-06-08 04:12:29'),
(44, '34', '7', '123', '2024-06-08 04:14:26'),
(45, '7', '34', 'you', '2024-06-08 04:15:04'),
(46, '7', '34', 'no', '2024-06-08 04:15:53'),
(47, '9', '34', 'hi', '2024-06-30 23:40:37'),
(48, '34', '9', 'hello', '2024-06-30 23:41:13'),
(49, '9', '34', 'lkm', '2024-06-30 23:42:00'),
(50, '9', '35', 'hi', '2024-07-22 13:39:23');

-- --------------------------------------------------------

--
-- Table structure for table `patients`
--

CREATE TABLE `patients` (
  `id` bigint(20) NOT NULL,
  `admin_id` bigint(255) UNSIGNED DEFAULT NULL,
  `doc_id` bigint(255) UNSIGNED DEFAULT NULL,
  `pat_fname` varchar(20) DEFAULT NULL,
  `pat_lname` varchar(20) DEFAULT NULL,
  `pat_dob` varchar(11) DEFAULT NULL,
  `pat_age` varchar(20) DEFAULT NULL,
  `pat_number` varchar(20) DEFAULT NULL,
  `pat_email` varchar(255) DEFAULT NULL,
  `pat_gender` varchar(11) DEFAULT NULL,
  `pat_addr` varchar(255) DEFAULT NULL,
  `pat_phone` varchar(20) DEFAULT NULL,
  `pat_type` varchar(15) DEFAULT NULL,
  `pat_ailment` varchar(100) DEFAULT NULL,
  `pat_country` varchar(50) DEFAULT NULL,
  `pat_reg_date` timestamp(6) NOT NULL DEFAULT current_timestamp(6) ON UPDATE current_timestamp(6),
  `pat_discharge_status` varchar(20) DEFAULT NULL,
  `hps` varchar(200) DEFAULT NULL,
  `ref_pin` varchar(20) DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  `tx_id` varchar(200) DEFAULT NULL,
  `date_time` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `patients`
--

INSERT INTO `patients` (`id`, `admin_id`, `doc_id`, `pat_fname`, `pat_lname`, `pat_dob`, `pat_age`, `pat_number`, `pat_email`, `pat_gender`, `pat_addr`, `pat_phone`, `pat_type`, `pat_ailment`, `pat_country`, `pat_reg_date`, `pat_discharge_status`, `hps`, `ref_pin`, `status`, `tx_id`, `date_time`) VALUES
(0, 0, NULL, 'Adeke', 'Samuel', '2024-08-07', '32', NULL, 'adekesam@gmail.com', 'male', 'Opp. Nigeria Brewery KM5 Gboko Road', '0987365729', NULL, 'Eye defect', 'Nigeria', '2024-08-07 19:53:12.388541', NULL, NULL, 'pcgwfapt-31318952', NULL, NULL, NULL),
(1, 4, NULL, 'John', 'Doe', '2020-01-03', '4', 'CEH123', 'johndoe@gmail.com', 'Female', 'Opp. Nigeria Brewery KM5 Gboko Road', '8923475609', 'In-patient', 'Eye defect', 'Makurdi, Benue State, Nigeria', '2024-03-18 23:28:06.999704', 'NULL', NULL, NULL, NULL, NULL, NULL),
(2, 4, NULL, 'Jane', 'Jodan', '2024-03-27', '32', 'CEH124', 'jane@gmail.com', 'Female', 'Y2001 Alpha-Rest AV2, Nigeria.', '8923475609', 'In-patient', 'Eye defect', 'Makurdi, Benue State, Nigeria', '2024-03-22 15:39:27.038404', 'Discharged', NULL, NULL, NULL, NULL, NULL),
(3, 4, NULL, 'Jane', 'Banks', '2024-03-04', '14', 'CEH125', 'jb@gmail.com', 'Female', 'Y2001 Alpha-Rest AV2, Nigeria.', '8923475609', 'Out-pateint', 'ailment demo', 'Makurdi, Benue State, Nigeria', '2024-03-22 15:38:58.072068', 'On-Medication', NULL, NULL, NULL, NULL, NULL),
(5, NULL, 4, 'Jay', 'Cool', '2024-03-25', '24', 'CEH126', 'jaycool@gmail.com', 'Male', 'Y2001 Alpha-Rest AV2, Nigeria.', '0987365729', 'Out-pateint', 'ailment demo2', 'Makurdi, Benue State, Nigeria', '2024-03-22 16:21:02.449218', NULL, NULL, NULL, NULL, NULL, NULL),
(6, NULL, 4, 'James ', 'Nater', '2024-03-11', '22', 'CEH127', 'james@gmail.com', 'Male', 'Opp. Nigeria Brewery KM5 Gboko Road', '89234756087', 'In-patient', 'ailment demo3', 'Makurdi, Benue State, Nigeria', '2024-03-22 17:31:47.523653', NULL, NULL, NULL, NULL, NULL, NULL),
(7, NULL, 6, 'Terna', 'Tor', '2024-04-30', '30', 'AHMS123', 'terna@gmail.com', 'Male', 'NG01 Alpharest, 0001AV2', '09047948447', 'Out-pateint', 'Demo Ailment', 'Nigeria', '2024-04-20 01:28:09.009931', 'Discharged', '2', NULL, NULL, NULL, NULL),
(8, NULL, 6, 'James', 'Tar', '2024-04-30', '32', 'AHMS124', 'james@gmail.com', 'Male', 'NG01 Alpharest, 0001AV2', '09048948009', 'In-patient', 'Demo Ailment', 'Makurdi, Benue Nigeria.', '2024-04-20 01:28:23.263191', 'NULL', '2', NULL, NULL, NULL, NULL),
(9, NULL, NULL, 'Ikpa', 'Senege', '2024-04-14', '18', 'AHMS125', 'senegeikpa@gmil.com', 'Female', 'NG01 Alpharest, 0001AV2', '09047948047', 'In-patient', 'Demo Ailment', 'Makurdi, Benue Nigeria.', '2024-04-20 01:52:09.564896', NULL, NULL, NULL, NULL, NULL, NULL),
(10, NULL, 7, 'James ', 'Torkwase', '2024-06-18', '32', 'CEH1234', 'james@gmail.com', 'Female', 'Opp. Nigeria Brewery KM5 Gboko Road', '8923475609', 'In-patient', 'Eye defect', 'Makurdi, Benue State, Nigeria', '2024-06-20 18:12:25.918882', NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `patient_assign`
--

CREATE TABLE `patient_assign` (
  `id` bigint(50) NOT NULL,
  `admin_id` bigint(255) UNSIGNED DEFAULT NULL,
  `doc_number` bigint(255) UNSIGNED DEFAULT NULL,
  `doc_fname` varchar(20) DEFAULT NULL,
  `doc_email` varchar(255) DEFAULT NULL,
  `doc_phone` varchar(20) DEFAULT NULL,
  `doc_dept` varchar(100) DEFAULT NULL,
  `pat_fname` varchar(20) DEFAULT NULL,
  `pat_lname` varchar(20) DEFAULT NULL,
  `pat_number` varchar(20) DEFAULT NULL,
  `pat_ailment` varchar(200) DEFAULT NULL,
  `date_time` timestamp(6) NOT NULL DEFAULT current_timestamp(6) ON UPDATE current_timestamp(6),
  `status` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `patient_transfer`
--

CREATE TABLE `patient_transfer` (
  `id` int(20) UNSIGNED NOT NULL,
  `admin_id` bigint(255) UNSIGNED DEFAULT NULL,
  `doc_id` bigint(255) UNSIGNED DEFAULT NULL,
  `pat_fname` varchar(20) DEFAULT NULL,
  `pat_lname` varchar(20) DEFAULT NULL,
  `pat_dob` varchar(15) DEFAULT NULL,
  `pat_email` varchar(255) DEFAULT NULL,
  `pat_age` varchar(5) DEFAULT NULL,
  `pat_gender` varchar(8) DEFAULT NULL,
  `pat_phone` varchar(20) DEFAULT NULL,
  `pat_country` varchar(50) DEFAULT NULL,
  `pat_number` varchar(50) DEFAULT NULL,
  `pat_addr` varchar(255) DEFAULT NULL,
  `pat_ailment` varchar(255) DEFAULT NULL,
  `ref_hospital` varchar(255) DEFAULT NULL,
  `status` varchar(11) NOT NULL,
  `date_time` timestamp(6) NOT NULL DEFAULT current_timestamp(6) ON UPDATE current_timestamp(6)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `patient_transfer`
--

INSERT INTO `patient_transfer` (`id`, `admin_id`, `doc_id`, `pat_fname`, `pat_lname`, `pat_dob`, `pat_email`, `pat_age`, `pat_gender`, `pat_phone`, `pat_country`, `pat_number`, `pat_addr`, `pat_ailment`, `ref_hospital`, `status`, `date_time`) VALUES
(1, 4, NULL, 'John', 'Doe', '2020-01-03', 'johndoe@gmail.com', '4', 'Female', '8923475609', 'Makurdi, Benue State, Nigeria', 'CEH123', 'Opp. Nigeria Brewery KM5 Gboko Road', 'Eye defect', 'Chaha Eye Hospital, KM5 Markurdi Road.', 'Transfered', '2024-03-18 15:06:51.773750'),
(2, NULL, 4, 'Jane', 'Banks', '2024-03-04', 'jb@gmail.com', '14', 'Female', '8923475609', 'Makurdi, Benue State, Nigeria', 'CEH125', 'Y2001 Alpha-Rest AV2, Nigeria.', 'ailment demo', 'Chaha Eye Hospital, KM5 Markurdi Road.', 'Transfered', '2024-03-22 15:51:42.294473'),
(3, NULL, 6, 'Terna', 'Tor', '2024-04-30', 'terna@gmail.com', '30', 'Male', '09047948447', 'Nigeria', 'AHMS123', 'NG01 Alpharest, 0001AV2', 'Demo Ailment', 'Chaha Eye Hospital', 'Transfered', '2024-04-20 00:04:31.521762');

-- --------------------------------------------------------

--
-- Table structure for table `payrolls`
--

CREATE TABLE `payrolls` (
  `pay_id` int(20) NOT NULL,
  `admin_id` bigint(255) UNSIGNED DEFAULT NULL,
  `pay_number` varchar(20) DEFAULT NULL,
  `pay_doc_name` varchar(20) DEFAULT NULL,
  `pay_doc_number` varchar(20) DEFAULT NULL,
  `pay_bank` varchar(50) DEFAULT NULL,
  `pay_acc_name` varchar(20) DEFAULT NULL,
  `pay_acc_number` varchar(20) DEFAULT NULL,
  `pay_doc_email` varchar(200) DEFAULT NULL,
  `pay_emp_salary` varchar(20) DEFAULT NULL,
  `pay_date_generated` timestamp(4) NOT NULL DEFAULT current_timestamp(4) ON UPDATE current_timestamp(4),
  `pay_descr` longtext DEFAULT NULL,
  `status` varchar(10) NOT NULL,
  `rid` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payrolls`
--

INSERT INTO `payrolls` (`pay_id`, `admin_id`, `pay_number`, `pay_doc_name`, `pay_doc_number`, `pay_bank`, `pay_acc_name`, `pay_acc_number`, `pay_doc_email`, `pay_emp_salary`, `pay_date_generated`, `pay_descr`, `status`, `rid`) VALUES
(3, 4, 'LRQ19', 'kator Azua', 'CEH123DK', NULL, NULL, '0556666359', 'kator@gmail.com', 'NGN 800,000.00', '2024-03-19 21:28:48.1869', '   this is demo category   ', 'Paid', NULL),
(4, 4, 'YVGJ5', 'James  Susan', 'CEH123JS', NULL, NULL, '0556666359', 'james@gmail.com', 'NGN 250,000.00', '2024-03-19 21:06:27.2755', ' ', 'Not paid', NULL),
(5, NULL, '19G6F', 'Kator Azua', 'AHMS/DOC/HBUDN', '**********', '***** ***** *****', '0000000000', 'katorazua@gmail.com', 'NGN 250,000.00', '2024-04-20 02:44:57.1626', ' ', 'NotPaid', '6');

-- --------------------------------------------------------

--
-- Table structure for table `pharmaceuticals`
--

CREATE TABLE `pharmaceuticals` (
  `id` int(20) NOT NULL,
  `admin_id` bigint(255) UNSIGNED DEFAULT NULL,
  `phar_name` varchar(200) DEFAULT NULL,
  `phar_bcode` varchar(200) DEFAULT NULL,
  `phar_desc` longtext DEFAULT NULL,
  `phar_qty` varchar(200) DEFAULT NULL,
  `phar_cat` varchar(200) DEFAULT NULL,
  `phar_vendor` varchar(200) DEFAULT NULL,
  `date_time` timestamp(6) NOT NULL DEFAULT current_timestamp(6) ON UPDATE current_timestamp(6)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pharmaceuticals`
--

INSERT INTO `pharmaceuticals` (`id`, `admin_id`, `phar_name`, `phar_bcode`, `phar_desc`, `phar_qty`, `phar_cat`, `phar_vendor`, `date_time`) VALUES
(1, 4, 'Demo Pharmaceutical Name', '0123456789', 'This is Demo Pharmaceutical Description Sunt est soluta temporibus accusantium neque nam maiores cumque temporibus. Tempora libero non est unde veniam est qui dolor. Ut sunt iure rerum quae quisquam autem eveniet perspiciatis odit. Fuga sequi sed ea saepe at unde.', '1000g, 20 cattons', 'Demo Pharmaceutical Category Name', 'Eye-cap Pharmacy company', '2024-04-27 17:10:43.775106');

-- --------------------------------------------------------

--
-- Table structure for table `pharmaceuticals_categories`
--

CREATE TABLE `pharmaceuticals_categories` (
  `id` int(20) NOT NULL,
  `admin_id` bigint(255) UNSIGNED DEFAULT NULL,
  `pharm_cat_name` varchar(200) DEFAULT NULL,
  `pharm_cat_vendor` varchar(200) DEFAULT NULL,
  `pharm_cat_desc` longtext DEFAULT NULL,
  `date_time` timestamp(6) NOT NULL DEFAULT current_timestamp(6) ON UPDATE current_timestamp(6)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pharmaceuticals_categories`
--

INSERT INTO `pharmaceuticals_categories` (`id`, `admin_id`, `pharm_cat_name`, `pharm_cat_vendor`, `pharm_cat_desc`, `date_time`) VALUES
(1, 4, 'Demo Pharmaceutical Category Name', 'Eye-cap Pharmacy company', 'This is Demo Pharmaceutical Category Name Description you can try our services, follow us on www.example.alpha.com', '2024-03-19 07:17:34.839111'),
(2, 33, 'Demo Category ', 'Choose Pharmaceutical Vendor...', 'tghheijjj&#039;pouujk', '2024-07-07 16:51:27.127197');

-- --------------------------------------------------------

--
-- Table structure for table `pricing`
--

CREATE TABLE `pricing` (
  `id` int(20) NOT NULL,
  `userid` int(20) DEFAULT NULL,
  `firstname` varchar(20) DEFAULT NULL,
  `lastname` varchar(20) DEFAULT NULL,
  `ref_code` varchar(20) DEFAULT NULL,
  `email` varchar(200) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `amount` varchar(20) DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  `tx_id` varchar(20) DEFAULT NULL,
  `subscription_start_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pricing`
--

INSERT INTO `pricing` (`id`, `userid`, `firstname`, `lastname`, `ref_code`, `email`, `phone`, `amount`, `status`, `tx_id`, `subscription_start_date`) VALUES
(1, NULL, 'kator', 'Azua', '081742695', 'kator@gmail.com', '8923475609', '500,000', NULL, NULL, '2024-05-23 15:40:49'),
(3, 34, 'Adeke', 'Susan', 'pcgwfsub-16840166', 'adekesuzzy@gmail.com', '0987365729', 'Silver(500000)', NULL, NULL, '2024-06-08 18:07:22'),
(4, 34, 'Adeke', 'Susan', 'pcgwfsub-29409081', 'adekesuzzy@gmail.com', '0987365729', 'Silver(500000)', NULL, NULL, '2024-06-08 18:21:28'),
(5, 34, 'Adeke', 'Susan', 'pcgwfsub-92551193', 'adekesuzzy@gmail.com', '0987365729', 'Silver(500000)', NULL, NULL, '2024-06-08 18:26:19'),
(6, 34, 'Adeke', 'Susan', 'pcgwfsub-62258445', 'adekesuzzy@gmail.com', '0987365729', 'Gold(750000)', NULL, NULL, '2024-06-08 18:27:23');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) NOT NULL,
  `admin_id` bigint(255) UNSIGNED DEFAULT NULL,
  `prd_name` varchar(100) DEFAULT NULL,
  `prd_price` varchar(20) DEFAULT NULL,
  `prd_cat` varchar(100) DEFAULT NULL,
  `prd_number` varchar(10) DEFAULT NULL,
  `prd_dsc` longtext DEFAULT NULL,
  `status` varchar(10) DEFAULT NULL,
  `date_time` timestamp(4) NOT NULL DEFAULT current_timestamp(4) ON UPDATE current_timestamp(4),
  `thumbnail` varchar(255) DEFAULT NULL,
  `prd_mdate` varchar(20) DEFAULT NULL,
  `prd_xpdate` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `admin_id`, `prd_name`, `prd_price`, `prd_cat`, `prd_number`, `prd_dsc`, `status`, `date_time`, `thumbnail`, `prd_mdate`, `prd_xpdate`) VALUES
(1, 4, 'Glasses', 'NGN 8,000.00', '1', 'LPt64Udi', 'this is product demo description', NULL, '2024-04-27 17:11:01.4783', '1710891014product-4.jpg', NULL, NULL),
(2, 4, 'Product 3', 'NGN 6,500.00', '1', 'WkJuqIbM', 'This is demo product description Sunt est soluta temporibus accusantium neque nam maiores cumque temporibus. Tempora libero non est unde veniam est qui dolor. Ut sunt iure rerum quae quisquam autem eveniet perspiciatis odit. Fuga sequi sed ea saepe at unde.Sunt est soluta temporibus accusantium neque nam maiores cumque temporibus. Tempora libero non est unde veniam est qui dolor. Ut sunt iure rerum quae quisquam autem eveniet perspiciatis odit. Fuga sequi sed ea saepe at unde.Sunt est soluta temporibus accusantium neque nam maiores cumque temporibus. Tempora libero non est unde veniam est qui dolor. Ut sunt iure rerum quae quisquam autem eveniet perspiciatis odit. Fuga sequi sed ea saepe at unde.', NULL, '2024-04-27 17:11:07.6899', '1710906375product-3.jpg', '08-2023', '07-2026'),
(4, 4, 'Product 1', 'NGN 12,050.00', '1', 'jSlyYCAX', 'this demo description', NULL, '2024-04-27 17:11:14.8779', '1710892039books-2.jpg', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `id` int(20) UNSIGNED NOT NULL,
  `title` varchar(50) NOT NULL,
  `prices` varchar(255) NOT NULL,
  `thumbnail` varchar(255) NOT NULL,
  `author_id` bigint(255) UNSIGNED NOT NULL,
  `date_time` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`id`, `title`, `prices`, `thumbnail`, `author_id`, `date_time`) VALUES
(1, 'Demo Services', '200,000.00', '1710504077card.jpg', 4, '2024-03-15 11:56:28');

-- --------------------------------------------------------

--
-- Table structure for table `support`
--

CREATE TABLE `support` (
  `id` int(20) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `email` varchar(200) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `amount` varchar(20) DEFAULT NULL,
  `ref_pin` varchar(20) DEFAULT NULL,
  `comment` text DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  `transaction_id` varchar(20) DEFAULT NULL,
  `date_time` timestamp(4) NOT NULL DEFAULT current_timestamp(4)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `support`
--

INSERT INTO `support` (`id`, `name`, `email`, `phone`, `amount`, `ref_pin`, `comment`, `status`, `transaction_id`, `date_time`) VALUES
(1, 'kator azua', 'kator@gmail.com', '0987365720', 'NGN 200,000', 'pcgwf12276080', 'hgfffffffff', NULL, NULL, '2024-06-08 14:31:42.7890'),
(2, 'kator azua', 'kator@gmail.com', '0987365720', 'NGN 200,000', 'pcgwf14524183', 'ertt', NULL, NULL, '2024-06-09 04:22:18.9879');

-- --------------------------------------------------------

--
-- Table structure for table `surgery`
--

CREATE TABLE `surgery` (
  `id` int(20) NOT NULL,
  `admin_id` bigint(255) UNSIGNED DEFAULT NULL,
  `doc_id` bigint(255) UNSIGNED DEFAULT NULL,
  `s_number` varchar(6) DEFAULT NULL,
  `s_doc` varchar(20) DEFAULT NULL,
  `s_pat_number` varchar(20) DEFAULT NULL,
  `s_pat_name` varchar(20) DEFAULT NULL,
  `s_pat_ailment` varchar(200) DEFAULT NULL,
  `s_pat_date` timestamp(6) NOT NULL DEFAULT current_timestamp(6) ON UPDATE current_timestamp(6),
  `s_pat_status` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `surgery`
--

INSERT INTO `surgery` (`id`, `admin_id`, `doc_id`, `s_number`, `s_doc`, `s_pat_number`, `s_pat_name`, `s_pat_ailment`, `s_pat_date`, `s_pat_status`) VALUES
(1, 4, NULL, '6LRAE', 'kator Azua', 'CEH123', 'John Doe', 'Eye defect', '2024-03-21 09:42:56.256786', 'Successful'),
(2, NULL, 4, '6SW0R', 'kator Azua', 'CEH127', 'James  Nater', 'ailment demo3', '2024-03-22 18:36:31.405687', 'Successful'),
(3, NULL, 4, 'N9ZIM', 'kator Azua', 'CEH128', 'John Ngumimi', 'ailment demo', '2024-03-23 00:02:14.468313', 'Successful'),
(4, NULL, 6, 'YCNIW', 'kator Azua', 'AHMS124', 'James Tar', 'Demo Ailment', '2024-04-20 00:56:16.641496', 'Successful'),
(5, NULL, 7, 'N53T8', 'Choose a Surgeon...', 'CEH1234', 'James  Torkwase', 'Eye defect', '2024-06-20 18:29:29.047982', 'Successful');

-- --------------------------------------------------------

--
-- Table structure for table `suscribe`
--

CREATE TABLE `suscribe` (
  `id` int(20) NOT NULL,
  `email` varchar(200) NOT NULL,
  `date_time` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `suscribe`
--

INSERT INTO `suscribe` (`id`, `email`, `date_time`) VALUES
(0, 'john@gmail.com', '2024-08-02 18:06:12'),
(1, 'katorazua674@gmail.com', '2024-05-24 09:14:44'),
(2, 'john@gmail.com', '2024-06-02 11:21:27'),
(3, 'king@gmail.com', '2024-06-02 11:30:49'),
(4, 'king@gmail.com', '2024-06-02 11:36:58'),
(5, 'empro3668@gmail.com', '2024-06-02 14:39:15'),
(6, 'king@gmail.com', '2024-06-02 14:59:03'),
(7, 'empro3668@gmail.com', '2024-06-02 14:59:20'),
(8, 'king@gmail.com', '2024-06-02 14:59:33'),
(9, 'john@gmail.com', '2024-06-02 14:59:52'),
(10, 'myemail@gmail.com', '2024-06-15 11:33:16');

-- --------------------------------------------------------

--
-- Table structure for table `testimonials`
--

CREATE TABLE `testimonials` (
  `id` int(255) UNSIGNED NOT NULL,
  `joinus_admin` int(20) DEFAULT NULL,
  `user_id` bigint(255) UNSIGNED NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `body` text NOT NULL,
  `occupation` varchar(50) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `avatar` varchar(255) NOT NULL,
  `date_time` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `testimonials`
--

INSERT INTO `testimonials` (`id`, `joinus_admin`, `user_id`, `firstname`, `lastname`, `body`, `occupation`, `email`, `phone`, `avatar`, `date_time`) VALUES
(1, NULL, 4, 'John', 'Doe', 'Lorem ipsum, dolor sit amet consectetur adipisicing elit. Dicta quod ipsa, natus in esse repellendus quae. Et sapiente quo natus ratione unde illum provident dicta pariatur in consequatur, voluptatibus libero.Lorem ipsum, dolor sit amet consectetur adipisicing elit. Dicta quod ipsa, natus in esse repellendus quae. Et sapiente quo natus ratione unde illum provident dicta pariatur in consequatur, voluptatibus libero.Lorem ipsum, dolor sit amet consectetur adipisicing elit. Dicta quod ipsa, natus in esse repellendus quae. Et sapiente quo natus ratione unde illum provident dicta pariatur in consequatur, voluptatibus libero.', 'Scientist', 'johndoe@gmail.com', '0987365729', '1710514417messages-3.jpg', '2024-03-15 14:53:37'),
(2, NULL, 4, 'kator', 'Azua', 'Lorem ipsum, dolor sit amet consectetur adipisicing elit. Dicta quod ipsa, natus in esse repellendus quae. Et sapiente quo natus ratione unde illum provident dicta pariatur in consequatur, voluptatibus libero.Lorem ipsum, dolor sit amet consectetur adipisicing elit. Dicta quod ipsa, natus in esse repellendus quae. Et sapiente quo natus ratione unde illum provident dicta pariatur in consequatur, voluptatibus libero.Lorem ipsum, dolor sit amet consectetur adipisicing elit. Dicta quod ipsa, natus in esse repellendus quae. Et sapiente quo natus ratione unde illum provident dicta pariatur in consequatur, voluptatibus libero.Lorem ipsum, dolor sit amet consectetur adipisicing elit. Dicta quod ipsa, natus in esse repellendus quae. Et sapiente quo natus ratione unde illum provident dicta pariatur in consequatur, voluptatibus libero.', 'Doctor', 'kator@gmail.com', '8923475609', '1710515038profile-team-3.jpg', '2024-03-15 14:56:04'),
(3, NULL, 4, 'James ', 'Mabel', 'Lorem ipsum, dolor sit amet consectetur adipisicing elit. Dicta quod ipsa, natus in esse repellendus quae. Et sapiente quo natus ratione unde illum provident dicta pariatur in consequatur, voluptatibus libero.Lorem ipsum, dolor sit amet consectetur adipisicing elit. Dicta quod ipsa, natus in esse repellendus quae. Et sapiente quo natus ratione unde illum provident dicta pariatur in consequatur, voluptatibus libero.Lorem ipsum, dolor sit amet consectetur adipisicing elit. Dicta quod ipsa, natus in esse repellendus quae. Et sapiente quo natus ratione unde illum provident dicta pariatur in consequatur, voluptatibus libero.Lorem ipsum, dolor sit amet consectetur adipisicing elit. Dicta quod ipsa, natus in esse repellendus quae. Et sapiente quo natus ratione unde illum provident dicta pariatur in consequatur, voluptatibus libero.Lorem ipsum, dolor sit amet consectetur adipisicing elit. Dicta quod ipsa, natus in esse repellendus quae. Et sapiente quo natus ratione unde illum provident dicta pariatur in consequatur, voluptatibus libero.', 'CEO', 'james@gmail.com', '0987365729', '1710514656messages-2.jpg', '2024-03-15 14:57:36');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(255) UNSIGNED NOT NULL,
  `admin_id` varchar(20) DEFAULT NULL,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `username` varchar(20) NOT NULL,
  `gender` varchar(8) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `addr` varchar(50) DEFAULT NULL,
  `city` varchar(50) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `avatar` varchar(400) NOT NULL,
  `userfield` varchar(50) NOT NULL,
  `user_mode` varchar(20) DEFAULT NULL,
  `terms` varchar(11) NOT NULL,
  `subscription_start_date` datetime DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  `role` varchar(20) NOT NULL,
  `reset_token_hash` varchar(64) DEFAULT NULL,
  `reset_token_expiration` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `admin_id`, `firstname`, `lastname`, `username`, `gender`, `email`, `phone`, `addr`, `city`, `password`, `avatar`, `userfield`, `user_mode`, `terms`, `subscription_start_date`, `status`, `role`, `reset_token_hash`, `reset_token_expiration`) VALUES
(0, NULL, 'Terfar', 'Abegial ', 'Aby', 'Female', 'aby@gmail.com', '0987365720', NULL, NULL, '$2y$10$UEnPzsG8nRCjmZtvJcuHx..XQ.4FhYb9Mpp2tCkLd7XV7dQdZtFt.', '1723049615messages-1.jpg', 'staff', 'Active now', 'I accept', NULL, NULL, 'Bronze', NULL, NULL),
(1, NULL, 'Alpha', 'Manager', 'alphaMyAdmin', 'Male', 'projectalpha@email.com', '09047948009', 'AV002 AlphaRest, JPAVN.', 'Nigeria', '$2y$10$E4dSV08blNqZZNQujX0gTOltJSBsbbCzzbuxQYWvUEQ4ggVymonOy', '1711158415Alpha-favicon.png', 'Admin|Manager', 'Active now', 'I accept', NULL, 'expired', 'Alpha', NULL, NULL),
(4, NULL, 'Azua', 'kator', 'Dr. Kay', 'Male', 'katorazua674@gmail.com', '09047948009', 'AlphaRest, Y2 NG', 'Makurdi, Benue State, Nigeria', '$2y$10$7432xA1dFuFuTxCUaqT44e/eGmiH/OIISgfxS7ceke/qGqpHnESHK', '1722636155logo.png', 'Web Developer', 'Offline', 'I accept', NULL, 'expired', 'super', NULL, NULL),
(33, NULL, 'James ', 'SI', 'james', 'Male', 'james@gmail.com', '0987365729', 'AlphaRest, Y2 N0002', 'Nigeria', '$2y$10$widuAZd9u5/sx1oFFFuRY.vNuTiADe8M3V2Vjn0g/ea0G7PkjY0oS', '1711392844team-3.jpg', 'Cybersecurity', 'Offline', 'I accept', NULL, 'expired', 'Admin', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `vendor`
--

CREATE TABLE `vendor` (
  `id` int(20) NOT NULL,
  `admin_id` bigint(255) UNSIGNED DEFAULT NULL,
  `v_name` varchar(200) DEFAULT NULL,
  `v_phone` varchar(20) DEFAULT NULL,
  `v_email` varchar(255) DEFAULT NULL,
  `v_number` varchar(8) DEFAULT NULL,
  `v_adr` varchar(100) DEFAULT NULL,
  `v_desc` text DEFAULT NULL,
  `date_time` timestamp(6) NOT NULL DEFAULT current_timestamp(6) ON UPDATE current_timestamp(6)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `vendor`
--

INSERT INTO `vendor` (`id`, `admin_id`, `v_name`, `v_phone`, `v_email`, `v_number`, `v_adr`, `v_desc`, `date_time`) VALUES
(1, 4, 'Eye-cap Pharmacy company', '09087654378', 'vendor@gmail.com', 'I6LYW', 'KM3 g-street', 'This is vendor demo description', '2024-03-19 02:27:58.219722');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `appointments`
--
ALTER TABLE `appointments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_projectchaha_cat_admin` (`admin_id`);

--
-- Indexes for table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_projectchaha_dept_admin` (`admin_id`);

--
-- Indexes for table `doctors`
--
ALTER TABLE `doctors`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `reset_token_hash` (`reset_token_hash`),
  ADD KEY `FK_projectchaha_admin_id` (`admin_id`);

--
-- Indexes for table `doc_transfer`
--
ALTER TABLE `doc_transfer`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_chaha_admin_id` (`admin_id`);

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_projectchaha_employee_admin_id` (`admin_id`);

--
-- Indexes for table `employee_transfer`
--
ALTER TABLE `employee_transfer`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_projectchaha_emp_admin_id` (`admin_id`);

--
-- Indexes for table `equipments`
--
ALTER TABLE `equipments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_projectchaha_category` (`category_id`),
  ADD KEY `FK_projectchaha_admin` (`author_id`);

--
-- Indexes for table `forgetpass`
--
ALTER TABLE `forgetpass`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `rest_token_hash` (`rest_token_hash`);

--
-- Indexes for table `introduction`
--
ALTER TABLE `introduction`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `laboratory`
--
ALTER TABLE `laboratory`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_projectchaha_lab_admin` (`admin_id`),
  ADD KEY `FK_projectchaha_lab_doc_id` (`doc_id`);

--
-- Indexes for table `medical_records`
--
ALTER TABLE `medical_records`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_projectchaha_mdr_admin` (`admin_id`),
  ADD KEY `FK_projectchaha_mdr_docID` (`doc_id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `patients`
--
ALTER TABLE `patients`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_projectchaha_doc_id` (`doc_id`),
  ADD KEY `FK_chaha_admin` (`admin_id`);

--
-- Indexes for table `patient_assign`
--
ALTER TABLE `patient_assign`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_chaha_adminID` (`admin_id`),
  ADD KEY `FK_projectchaha_doc_number` (`doc_number`);

--
-- Indexes for table `patient_transfer`
--
ALTER TABLE `patient_transfer`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_CEH_adminID` (`admin_id`),
  ADD KEY `FK_CEH_doc_id` (`doc_id`);

--
-- Indexes for table `payrolls`
--
ALTER TABLE `payrolls`
  ADD PRIMARY KEY (`pay_id`);

--
-- Indexes for table `pharmaceuticals`
--
ALTER TABLE `pharmaceuticals`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pharmaceuticals_categories`
--
ALTER TABLE `pharmaceuticals_categories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_pharm_cat_admin` (`admin_id`);

--
-- Indexes for table `pricing`
--
ALTER TABLE `pricing`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_projectchaha_prd_admin` (`admin_id`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_projectchaha_user` (`author_id`);

--
-- Indexes for table `support`
--
ALTER TABLE `support`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `surgery`
--
ALTER TABLE `surgery`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `suscribe`
--
ALTER TABLE `suscribe`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `testimonials`
--
ALTER TABLE `testimonials`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_projectchaha_userID` (`user_id`),
  ADD KEY `FK_projectchaha_test_joinus_admin` (`joinus_admin`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `rest_token_hash` (`reset_token_hash`);

--
-- Indexes for table `vendor`
--
ALTER TABLE `vendor`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_projectchaha_v_admin_id` (`admin_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `appointments`
--
ALTER TABLE `appointments`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(255) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `contact`
--
ALTER TABLE `contact`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `department`
--
ALTER TABLE `department`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `doctors`
--
ALTER TABLE `doctors`
  MODIFY `id` bigint(255) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
