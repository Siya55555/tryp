-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 17, 2025 at 01:55 AM
-- Server version: 8.0.42
-- PHP Version: 8.3.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dzm_trypbugsite`
--

-- --------------------------------------------------------

--
-- Table structure for table `blogs`
--

CREATE TABLE `blogs` (
  `id` bigint UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `excerpt` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `featured_image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'draft',
  `category_id` bigint UNSIGNED NOT NULL,
  `author` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `author_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `author_bio` text COLLATE utf8mb4_unicode_ci,
  `read_time` int NOT NULL DEFAULT '5',
  `views` int NOT NULL DEFAULT '0',
  `published_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `blogs`
--

INSERT INTO `blogs` (`id`, `title`, `slug`, `excerpt`, `content`, `featured_image`, `status`, `category_id`, `author`, `author_image`, `author_bio`, `read_time`, `views`, `published_at`, `created_at`, `updated_at`) VALUES
(1, 'Why Orlando Should Be Your Next Summer Getaway', 'why-orlando-should-be-your-next-summer-getaway', 'Discover why Orlando is more than just theme parks. From hidden natural springs to vibrant food scenes, Orlando offers unexpected adventures for every type of traveler.', '<p>Orlando, Florida, is a dream summer getaway, offering world-famous theme parks, vibrant entertainment, and sunny skies. Whether you\'re traveling as a family, couple, or solo explorer, Orlando provides unforgettable experiences.</p><h2>Relax in Comfort: Your Home Away From Home</h2><p>With our selection of premium vacation rentals, you\'ll enjoy a daily and nightly stay at a premium resort—putting you right in the heart of the action. Imagine waking up in a comfortable suite, sipping coffee on your own balcony, and planning your day\'s adventures.</p><p>Our Orlando properties offer spacious accommodations with full kitchens, multiple bedrooms, and resort amenities that far surpass what you\'d find in a standard hotel room. After a day of exploration, return to your own private space to relax and recharge.</p><p><img src=\"https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTMQv_rnx-DQLnWqX2ZzHM0t_Eiyhn0tsTWng&amp;s\" alt=\"Luxury Orlando vacation rental interior\"></p><h2>Create Your Own Orlando Experience</h2><p>While our packages include all the essentials, how you enjoy your Orlando stay is completely up to you! Here are some ways to make the most of your summer adventure:</p><h3>Theme Park Thrills</h3><p>Visit Walt Disney World, Universal Orlando, or SeaWorld for unforgettable rides and attractions. The summer months bring special events and extended hours to many parks, giving you more time to enjoy your favorite attractions.</p><h3>Natural Escapes</h3><p>Many travelers don\'t realize that Orlando is home to stunning natural beauty. Take a break from the parks to explore Wekiwa Springs State Park, where crystal-clear waters maintain a refreshing 72 degrees year-round – perfect for a summer cool-down. Or paddle through the picturesque Winter Park Chain of Lakes for a peaceful afternoon away from the crowds.</p><p><img src=\"https://www.orlandosentinel.com/wp-content/uploads/migration/2020/07/01/52BCNB4AHFFSVKVGEJ7UQOFGKU.jpg?w=1024&amp;h=670\" alt=\"Wekiwa Springs in Orlando\"></p><h3>Culinary Delights</h3><p>Orlando\'s food scene extends far beyond theme park fare. The city boasts a vibrant collection of restaurants offering everything from international cuisine to farm-to-table dining. Visit the East End Market for local artisanal foods or explore Restaurant Row on Sand Lake Road for upscale dining options.</p><h3>Shopping Extravaganza</h3><p>Browse luxury brands and outlet deals at The Mall at Millenia and Orlando International Premium Outlets. For a unique shopping experience, visit Disney Springs or Universal CityWalk, where entertainment and dining complement your shopping adventure.</p><h3>Outdoor Adventures</h3><p>Take a scenic boat tour on Lake Eola Park, or check out Orlando\'s scenic hiking trails. With pleasant morning temperatures, summer is an excellent time to enjoy Orlando\'s outdoor offerings before hitting the parks later in the day.</p><h2>Why Book with Us?</h2><p>Our Orlando package is designed to provide you with the perfect balance of adventure and relaxation. Our personal concierge—not the front desk—is there to ensure your Summer vacation is one for the books.</p><p>From helping you secure park tickets to recommending off-the-beaten-path attractions, we\'re committed to creating a customized experience that matches your travel style. With guaranteed lower rates than booking directly, you\'ll enjoy premium accommodations while saving on your summer getaway.</p><h2>Book Your Summer Escape Today!</h2><p>Orlando summer reservations fill up quickly, so don\'t delay and start counting down to your dream getaway.</p>', 'https://images.unsplash.com/photo-1530375323520-248ebdaa967f?q=80&w=2069&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D', 'published', 1, 'Michael Rodriguez', 'https://images.unsplash.com/photo-1568602471122-7832951cc4c5?q=80&w=2070&auto=format&fit=crop', 'Michael is a travel enthusiast with over 10 years of experience exploring destinations around the world. He specializes in family-friendly vacation planning and theme park adventures.', 5, 4289, '2023-04-10 18:00:00', '2025-04-29 10:18:02', '2025-05-02 16:08:53'),
(2, 'St. Patrick\'s Day Getaways to Remember', 'st-patricks-day-getaways-to-remember', 'Explore the best destinations to celebrate St. Patrick\'s Day, from Dublin\'s historic festivities to Chicago\'s green river tradition.', '<p>March is here, and with it comes the beloved St. Patrick\'s Day! Whether you\'re drawn to lively parades, rich cultural experiences, or simply enjoy the festivities, there\'s no better way to celebrate than with a dedicated getaway.</p><h2>Dublin, Ireland: The Authentic Experience</h2><p>There\'s no place quite like Dublin to experience St. Patrick\'s Day in its full glory. The Irish capital transforms into a sea of green with a multi-day festival culminating in the grand St. Patrick\'s Festival Parade on March 17th.</p><p>Beyond the parade, visitors can enjoy live music performances throughout the city, traditional Irish dancing, and special exhibitions highlighting Irish culture and history. Don\'t miss the chance to tour the Guinness Storehouse, where you can learn to pour the perfect pint and enjoy panoramic views of the city from the Gravity Bar.</p><p><img src=\"https://images.unsplash.com/photo-1590089415225-401ed6f9db8e?q=80&amp;w=2069&amp;auto=format&amp;fit=crop\" alt=\"Dublin St. Patrick\'s Day Parade\"></p><h3>Where to Stay</h3><p>Book accommodations in the Temple Bar area for easy access to festivities, or consider the more residential Ballsbridge neighborhood for a quieter retreat after the celebrations.</p><h2>Chicago, Illinois: Green Rivers and Grand Parades</h2><p>Chicago knows how to celebrate St. Patrick\'s Day in style! The city\'s most famous tradition is dyeing the Chicago River a vibrant emerald green—a spectacular sight that draws thousands of spectators each year. This grand display is followed by one of the largest St. Patrick\'s Day parades in the United States.</p><p>The Chicago festivities have a distinctly American flair while honoring the city\'s strong Irish heritage. Local Irish pubs throughout the city offer special events, live music, and traditional Irish fare throughout the weekend.</p><p><img src=\"https://images.unsplash.com/photo-1730815933703-1a04dae7fbc4?q=80&amp;w=2067&amp;auto=format&amp;fit=crop&amp;ixlib=rb-4.0.3&amp;ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D\" alt=\"Chicago River dyed green for St. Patrick\'s Day\"></p><h3>Planning Tip</h3><p>Chicago typically holds its St. Patrick\'s Day parade and river dyeing on the Saturday before March 17th, so plan accordingly if you want to witness these iconic events.</p><h2>Boston, Massachusetts: America\'s Irish Heart</h2><p>With one of America\'s largest Irish-American populations, Boston hosts a St. Patrick\'s Day celebration steeped in history and tradition. The South Boston St. Patrick\'s Day Parade dates back to 1901 and winds through the historically Irish neighborhood of South Boston (affectionately known as \"Southie\").</p><p>Beyond the parade, Boston offers Irish-themed pub crawls, special concerts featuring Irish musicians, and cultural events throughout the city. History buffs will appreciate the chance to explore the city\'s deep Irish heritage through specialized walking tours available during the season.</p><h3>Local Experience</h3><p>For an authentic experience, catch an Irish music session at The Burren in Somerville or enjoy traditional Irish fare at Greenhills Irish Bakery in Dorchester.</p><h2>Savannah, Georgia: Southern Charm Meets Irish Tradition</h2><p>Perhaps surprising to some, Savannah hosts one of the largest St. Patrick\'s Day celebrations in the United States. The city\'s historic downtown transforms into a massive street party, with a parade featuring over 350 units marching through the historic district.</p><p>What makes Savannah\'s celebration unique is the blend of Southern hospitality with Irish traditions, creating a festive atmosphere unlike any other. The city\'s open container laws allow visitors to enjoy their beverages while strolling through the beautiful squares and parks adorned in green for the occasion.</p><p><img src=\"https://images.unsplash.com/photo-1589845545366-a11f8a347708?q=80&amp;w=1965&amp;auto=format&amp;fit=crop\" alt=\"Historic Savannah decorated for St. Patrick\'s Day\"></p><h2>New Orleans, Louisiana: A Unique Twist on Tradition</h2><p>New Orleans puts its own unique spin on St. Patrick\'s Day with multiple parades and block parties throughout the city. The most famous tradition involves parade floats where riders toss cabbage, carrots, potatoes, and other ingredients for an Irish stew to spectators lining the routes.</p><p>The Irish Channel neighborhood hosts the main parade and block party, where locals and visitors alike can enjoy Irish music, dancing, and cuisine with that special New Orleans flair.</p><h2>Planning Your St. Patrick\'s Day Getaway</h2><p>No matter which destination you choose, here are some tips to make the most of your St. Patrick\'s Day adventure:</p><ul><li>Book accommodations well in advance, as hotels in popular St. Patrick\'s Day destinations fill up quickly</li><li>Pack plenty of green attire to get into the festive spirit</li><li>Research parade routes and event schedules before your trip</li><li>Make dinner reservations at popular Irish restaurants ahead of time</li><li>Consider visiting for the entire weekend, as many cities host events before and after March 17th</li></ul><p>Whether you\'re of Irish descent or simply enjoy joining in the celebration, a St. Patrick\'s Day getaway offers a wonderful opportunity to experience unique traditions, delicious food and drink, and jubilant atmospheres in cities across the world.</p>', 'https://images.unsplash.com/photo-1500995617113-cf789362a3e1?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D', 'published', 1, 'Sarah O\'Connor', 'https://images.unsplash.com/photo-1580489944761-15a19d654956?q=80&w=1961&auto=format&fit=crop', 'Sarah is an Irish-American travel writer with a passion for cultural celebrations. She has personally experienced St. Patrick\'s Day festivities on three continents and loves sharing insider tips for authentic experiences.', 6, 3150, '2023-03-13 18:00:00', '2025-04-29 10:18:02', '2025-05-01 11:35:58'),
(3, 'Why a Valentine\'s Day Getaway Beats Chocolates & Flowers', 'why-valentines-day-getaway-beats-chocolates-and-flowers', 'Skip the traditional gifts and surprise your loved one with a romantic getaway. We share the most romantic destinations around the world.', '<div class=\"max-w-4xl mx-auto px-4\"><p class=\"text-xl text-gray-700 mb-6 font-medium leading-relaxed\">This Valentine\'s Day, instead of the predictable chocolates and flowers, why not surprise your significant other with something more memorable? A romantic getaway creates lasting memories and provides quality time together—something no heart-shaped box can deliver.</p><h2 class=\"text-2xl font-semibold text-gray-800 mt-8 mb-4\">The Gift of Experiences Over Things</h2><p class=\"text-gray-600 mb-6 leading-relaxed\">Research consistently shows that experiences bring more lasting happiness than material possessions. A romantic getaway offers both immediate excitement and anticipation before the trip, as well as cherished memories long after you\'ve returned home.</p><p class=\"text-gray-600 mb-6 leading-relaxed\">While chocolates disappear quickly and flowers wilt, the stories and photos from your Valentine\'s escape will be treasured for years to come. Plus, planning the trip together can be a bonding experience in itself.</p><div class=\"my-8\"><img src=\"https://images.unsplash.com/photo-1584943249898-5abce1bfe612?q=80&w=1974&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D\" alt=\"Couple enjoying sunset on a beach getaway\" class=\"max-w-full h-auto rounded-lg shadow-md object-cover\" /></div><h2 class=\"text-2xl font-semibold text-gray-800 mt-8 mb-4\">Top Romantic Destinations for Valentine\'s Day</h2><h3 class=\"text-xl font-medium text-gray-700 mt-6 mb-3\">1. Santorini, Greece: Sunsets and Serenity</h3><p class=\"text-gray-600 mb-6 leading-relaxed\">Few places match the romance of Santorini\'s whitewashed buildings perched on dramatic cliffs overlooking the deep blue Aegean Sea. February offers a more intimate experience without the summer crowds, allowing you to enjoy the island\'s spectacular sunsets, boutique hotels, and exquisite Mediterranean cuisine in relative tranquility.</p><p class=\"text-gray-600 mb-6 leading-relaxed\">Stay in a cave hotel in Oia for the ultimate romantic experience, complete with private terraces and plunge pools overlooking the caldera.</p><h3 class=\"text-xl font-medium text-gray-700 mt-6 mb-3\">2. Venice, Italy: Timeless Romance</h3><p class=\"text-gray-600 mb-6 leading-relaxed\">Venice seems designed for romantic getaways with its scenic canals, historic architecture, and intimate atmosphere. February is during the city\'s iconic Carnival season, adding an element of mystery and festivity to your visit. Take a private gondola ride at sunset, get lost together in the city\'s narrow streets, and share cicchetti (Venetian tapas) and local wine at a cozy bacaro.</p><div class=\"my-8\"><img src=\"https://images.unsplash.com/photo-1514890547357-a9ee288728e0?q=80&w=2070&auto=format&fit=crop\" alt=\"Romantic gondola ride in Venice\" class=\"max-w-full h-auto rounded-lg shadow-md object-cover\" /></div><h3 class=\"text-xl font-medium text-gray-700 mt-6 mb-3\">3. Kyoto, Japan: Serene Beauty</h3><p class=\"text-gray-600 mb-6 leading-relaxed\">For couples seeking something different, Kyoto offers a blend of cultural richness and natural beauty. February brings the possibility of light snow dusting the city\'s hundreds of temples and shrines, creating magical winter scenes. Stay in a traditional ryokan with private onsen (hot spring bath), stroll through the bamboo groves of Arashiyama, and experience a traditional tea ceremony together.</p><h3 class=\"text-xl font-medium text-gray-700 mt-6 mb-3\">4. Quebec City, Canada: Winter Wonderland</h3><p class=\"text-gray-600 mb-6 leading-relaxed\">Embrace the winter season with a visit to Quebec City, where cobblestone streets, historic architecture, and French influence create a European atmosphere closer to home. The city glows with lights in February, and you can snuggle up during a horse-drawn carriage ride, go ice skating hand-in-hand, or warm up with gourmet French-Canadian cuisine in a cozy restaurant.</p><h3 class=\"text-xl font-medium text-gray-700 mt-6 mb-3\">5. Sedona, Arizona: Desert Romance</h3><p class=\"text-gray-600 mb-6 leading-relaxed\">Sedona\'s dramatic red rock formations and spiritual vibe make it perfect for couples seeking both adventure and relaxation. February offers mild temperatures ideal for hiking the scenic trails. Book a couple\'s massage with red rock views, take a sunrise hot air balloon ride, and stargaze in the crystal-clear desert skies far from city lights.</p><div class=\"my-8\"><img src=\"https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRwH9cClMXeWwyah-V6WvbcyLRninMo-htlUA&s\" alt=\"Red rock formations in Sedona at sunset\" class=\"max-w-full h-auto rounded-lg shadow-md object-cover\" /></div><h2 class=\"text-2xl font-semibold text-gray-800 mt-8 mb-4\">Making the Most of Your Valentine\'s Getaway</h2><h3 class=\"text-xl font-medium text-gray-700 mt-6 mb-3\">Personalize Your Experience</h3><p class=\"text-gray-600 mb-6 leading-relaxed\">The most memorable romantic getaways reflect both partners\' interests. If you love adventure, include a hike to a stunning viewpoint or a new activity you can try together. If relaxation is your priority, ensure your accommodation offers spa services or a private hot tub.</p><h3 class=\"text-xl font-medium text-gray-700 mt-6 mb-3\">Plan Surprises Within the Trip</h3><p class=\"text-gray-600 mb-6 leading-relaxed\">Elevate your getaway by planning small surprises throughout—perhaps a special dinner reservation, a thoughtful gift waiting in the hotel room, or a surprise activity your partner has always wanted to try.</p><h3 class=\"text-xl font-medium text-gray-700 mt-6 mb-3\">Disconnect to Reconnect</h3><p class=\"text-gray-600 mb-6 leading-relaxed\">Consider limiting screen time during your getaway to focus fully on each other and your surroundings. Many luxury resorts now offer \"digital detox\" packages that encourage guests to unplug and be present.</p><h3 class=\"text-xl font-medium text-gray-700 mt-6 mb-3\">Capture the Memories</h3><p class=\"text-gray-600 mb-6 leading-relaxed\">While it\'s important to stay present, take some time to document your special moments together. Consider hiring a local photographer for a short session, or simply designate times to take photos of each other and together.</p><h2 class=\"text-2xl font-semibold text-gray-800 mt-8 mb-4\">Budget-Friendly Valentine\'s Getaways</h2><p class=\"text-gray-600 mb-6 leading-relaxed\">A romantic escape doesn\'t have to break the bank. Consider these affordable alternatives:</p><ul class=\"list-disc pl-6 mb-6 text-gray-600 leading-relaxed\"><li>A cozy cabin rental in a nearby state park</li><li>A bed and breakfast in a charming small town within driving distance</li><li>A staycation at a local hotel with spa amenities</li><li>An Airbnb with unique features like a fireplace or hot tub</li></ul><h2 class=\"text-2xl font-semibold text-gray-800 mt-8 mb-4\">Book Your Valentine\'s Getaway Today</h2><p class=\"text-gray-600 mb-6 leading-relaxed\">This year, replace the expected with the exceptional by planning a Valentine\'s Day getaway that reflects your unique relationship. Whether you choose a far-flung destination or a special spot closer to home, the gift of travel and shared experiences will create memories far more valuable than any traditional Valentine\'s present.</p><p class=\"text-gray-600 mb-6 leading-relaxed\">Our travel experts can help you plan the perfect romantic escape tailored to your preferences and budget. Contact us today to start planning your unforgettable Valentine\'s celebration.</p></div>', 'https://townsquare.media/site/341/files/2017/02/Chocolate1.jpg?w=780&q=75', 'published', 2, 'Emma Chen', 'https://images.unsplash.com/photo-1499952127939-9bbf5af6c51c?q=80&w=1976&auto=format&fit=crop', 'Emma is a romance and luxury travel specialist who has planned hundreds of couples\' getaways. She believes that the best gifts are experiences shared with those you love.', 7, 4568, '2023-02-11 18:00:00', '2025-04-29 10:18:02', '2025-04-29 10:18:02'),
(4, 'The Best Times to Visit Cancun', 'the-best-times-to-visit-cancun', 'Find the perfect balance between great weather, fewer crowds, and better prices with our guide to the best seasons for visiting Cancun.', '<div class=\"max-w-4xl mx-auto px-4\"><p class=\"text-xl text-gray-700 mb-6 font-medium leading-relaxed\">Cancun, with its pristine white-sand beaches and crystal-clear turquoise waters, is a dream destination for many travelers. But timing is everything when planning your Mexican Caribbean getaway. This guide will help you determine the ideal time to visit based on your priorities: weather, crowds, and budget.</p><h2 class=\"text-2xl font-semibold text-gray-800 mt-8 mb-4\">Weather Patterns in Cancun: A Seasonal Overview</h2><h3 class=\"text-xl font-medium text-gray-700 mt-6 mb-3\">High Season (December to April)</h3><p class=\"text-gray-600 mb-6 leading-relaxed\">Cancun\'s high season coincides with winter in North America and Europe, when travelers escape cold weather for tropical warmth. During these months, you can expect:</p><ul class=\"list-disc pl-6 mb-6 text-gray-600 leading-relaxed\"><li>Average temperatures between 75°F and 82°F (24-28°C)</li><li>Minimal rainfall (typically less than 2 inches per month)</li><li>Low humidity levels</li><li>Gentle sea breezes</li><li>Excellent visibility for snorkeling and diving</li></ul><p class=\"text-gray-600 mb-6 leading-relaxed\">February and March offer particularly idyllic conditions, with warm days, comfortable nights, and the lowest chance of rain all year.</p><div class=\"my-8\"><img src=\"https://images.unsplash.com/photo-1513322759586-de797ee0866f?q=80&w=1974&auto=format&fit=crop\" alt=\"Cancun beach during high season with perfect weather\" class=\"max-w-full h-auto rounded-lg shadow-md object-cover\" /></div><h3 class=\"text-xl font-medium text-gray-700 mt-6 mb-3\">Shoulder Seasons (May & November)</h3><p class=\"text-gray-600 mb-6 leading-relaxed\">These transitional months offer an excellent balance of good weather and value:</p><ul class=\"list-disc pl-6 mb-6 text-gray-600 leading-relaxed\"><li>May: Temperatures begin to climb (80-85°F/27-29°C) with increasing humidity, but the serious heat and rain of summer haven\'t yet arrived</li><li>November: The rainy season is ending, temperatures are moderating (77-82°F/25-28°C), and the landscape is lush from the previous months\' rainfall</li></ul><h3 class=\"text-xl font-medium text-gray-700 mt-6 mb-3\">Low Season (June to October)</h3><p class=\"text-gray-600 mb-6 leading-relaxed\">Summer and early fall bring challenging weather conditions to Cancun:</p><ul class=\"list-disc pl-6 mb-6 text-gray-600 leading-relaxed\"><li>Hot temperatures (often exceeding 90°F/32°C)</li><li>High humidity (often 80%+)</li><li>Regular rainfall, particularly in September and October (7-8 inches monthly)</li><li>Hurricane season officially runs June 1 to November 30, with peak risk in September and October</li></ul><p class=\"text-gray-600 mb-6 leading-relaxed\">However, it\'s worth noting that even during the rainy season, showers are typically brief afternoon events rather than all-day downpours.</p><h2 class=\"text-2xl font-semibold text-gray-800 mt-8 mb-4\">Best Times to Visit Based on Your Priorities</h2><h3 class=\"text-xl font-medium text-gray-700 mt-6 mb-3\">For Perfect Weather: February to Early April</h3><p class=\"text-gray-600 mb-6 leading-relaxed\">If ideal beach conditions are your top priority, mid-winter through early spring offers the most reliable weather. The ocean is calm and clear, temperatures are warm but not scorching, and rain is minimal. This is the perfect time for water activities and all-day beach lounging.</p><h3 class=\"text-xl font-medium text-gray-700 mt-6 mb-3\">For Fewer Crowds: May and November</h3><p class=\"text-gray-600 mb-6 leading-relaxed\">The shoulder seasons offer a sweet spot of good weather with significantly reduced tourist numbers. You\'ll enjoy:</p><ul class=\"list-disc pl-6 mb-6 text-gray-600 leading-relaxed\"><li>Shorter wait times at popular restaurants and attractions</li><li>More space on the beaches</li><li>A more relaxed atmosphere throughout the Hotel Zone</li><li>Better service due to less strain on local resources</li></ul><div class=\"my-8\"><img src=\"https://images.unsplash.com/photo-1552074284-5e88ef1aef18?q=80&w=2070&auto=format&fit=crop\" alt=\"Uncrowded Cancun beach during shoulder season\" class=\"max-w-full h-auto rounded-lg shadow-md object-cover\" /></div><h3 class=\"text-xl font-medium text-gray-700 mt-6 mb-3\">For Budget Travel: Late August to Early November</h3><p class=\"text-gray-600 mb-6 leading-relaxed\">If you\'re looking to maximize value, the late summer and fall offer substantial savings:</p><ul class=\"list-disc pl-6 mb-6 text-gray-600 leading-relaxed\"><li>Hotel rates can be 40-50% lower than peak season</li><li>Many resorts offer special promotions and free night deals</li><li>Airfares drop significantly, especially from North American cities</li><li>Restaurants and tour operators often run low-season specials</li></ul><p class=\"text-gray-600 mb-6 leading-relaxed\">September is typically the absolute cheapest month, but it also has the highest rainfall and hurricane risk.</p><h3 class=\"text-xl font-medium text-gray-700 mt-6 mb-3\">For Special Experiences: Seasonal Events</h3><p class=\"text-gray-600 mb-6 leading-relaxed\"><strong>Whale Shark Season (Mid-May to Mid-September):</strong> During these months, the world\'s largest fish gather in the waters off Cancun. Swimming alongside these gentle giants is an unforgettable experience.</p><p class=\"text-gray-600 mb-6 leading-relaxed\"><strong>Sea Turtle Nesting Season (May to October):</strong> Witness female turtles laying eggs on the beaches or, if you\'re lucky, see hatchlings making their way to the sea.</p><p class=\"text-gray-600 mb-6 leading-relaxed\"><strong>Day of the Dead (Late October to Early November):</strong> Experience this unique Mexican holiday with special events, colorful decorations, and cultural performances.</p><h2 class=\"text-2xl font-semibold text-gray-800 mt-8 mb-4\">Month-by-Month Breakdown</h2><h3 class=\"text-xl font-medium text-gray-700 mt-6 mb-3\">January-February</h3><p class=\"text-gray-600 mb-6 leading-relaxed\">Peak tourist season with perfect weather. Expect high prices and advance reservations required for top restaurants and tours. The ocean is calm and ideal for swimming.</p><h3 class=\"text-xl font-medium text-gray-700 mt-6 mb-3\">March-April</h3><p class=\"text-gray-600 mb-6 leading-relaxed\">Spring Break brings crowds of college students, particularly in March. Easter week is extremely busy with Mexican and international travelers. Weather remains excellent.</p><h3 class=\"text-xl font-medium text-gray-700 mt-6 mb-3\">May</h3><p class=\"text-gray-600 mb-6 leading-relaxed\">A transition month with warming temperatures but still manageable humidity. Tourist crowds thin out after early May, and prices begin to drop. Water visibility is excellent for snorkeling and diving.</p><h3 class=\"text-xl font-medium text-gray-700 mt-6 mb-3\">June-August</h3><p class=\"text-gray-600 mb-6 leading-relaxed\">Hot and humid with increasing chance of afternoon showers. Hurricane risk begins but is relatively low. Despite being summer vacation time in many countries, this is not peak season for Cancun due to the weather.</p><div class=\"my-8\"><img src=\"https://images.unsplash.com/photo-1590001155093-a3c66ab0c3ff?q=80&w=2070&auto=format&fit=crop\" alt=\"Cancun resort during summer season\" class=\"max-w-full h-auto rounded-lg shadow-md object-cover\" /></div><h3 class=\"text-xl font-medium text-gray-700 mt-6 mb-3\">September-October</h3><p class=\"text-gray-600 mb-6 leading-relaxed\">The height of rainy season and hurricane risk. This is Cancun at its most humid and least crowded. Exceptional deals are available, but weather contingency plans are advisable.</p><h3 class=\"text-xl font-medium text-gray-700 mt-6 mb-3\">November</h3><p class=\"text-gray-600 mb-6 leading-relaxed\">Weather improves dramatically by mid-month. Early November offers excellent value before thanksgiving brings the first wave of high-season visitors.</p><h3 class=\"text-xl font-medium text-gray-700 mt-6 mb-3\">December</h3><p class=\"text-gray-600 mb-6 leading-relaxed\">The transition to high season is complete by mid-month. Christmas and New Year\'s weeks are the most expensive and crowded of the entire year, requiring bookings months in advance.</p><h2 class=\"text-2xl font-semibold text-gray-800 mt-8 mb-4\">Final Recommendations</h2><h3 class=\"text-xl font-medium text-gray-700 mt-6 mb-3\">Best Overall Time to Visit: May or Early November</h3><p class=\"text-gray-600 mb-6 leading-relaxed\">These periods offer the optimal combination of good weather, reasonable prices, and manageable crowds. You\'ll enjoy near-perfect conditions without the peak-season premium or long lines.</p><h3 class=\"text-xl font-medium text-gray-700 mt-6 mb-3\">If Weather is Your Priority: February</h3><p class=\"text-gray-600 mb-6 leading-relaxed\">This month offers the best chance of perfect beach days with minimal rain, ideal temperatures, and low humidity.</p><h3 class=\"text-xl font-medium text-gray-700 mt-6 mb-3\">If Budget is Your Priority: September</h3><p class=\"text-gray-600 mb-6 leading-relaxed\">If you\'re willing to risk some rain and potential storm disruptions, September offers rock-bottom prices. Just purchase travel insurance and maintain flexible plans.</p><p class=\"text-gray-600 mb-6 leading-relaxed\">Whatever time you choose to visit, Cancun\'s natural beauty and warm hospitality await. Our travel experts can help you plan the perfect Cancun getaway tailored to your preferences and priorities.</p></div>', 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcS51iiUe-C26-MAlMHLl4bJ_4hCMnFXBPoXww&s', 'published', 1, 'Carlos Mendez', 'https://images.unsplash.com/photo-1566492031773-4f4e44671857?q=80&w=1974&auto=format&fit=crop', 'Carlos is a Mexico travel specialist who grew up in Cancun and has been working in the tourism industry for over 15 years. He provides insider knowledge on the best times to experience the Mexican Caribbean.', 8, 5672, '2023-02-07 18:00:00', '2025-04-29 10:18:02', '2025-04-29 10:18:02'),
(5, '5 Hidden Gems in St. Thomas That Tourists Often Miss', '5-hidden-gems-in-st-thomas-that-tourists-often-miss', 'Go beyond the popular beaches and discover the secret spots that locals love but tourists rarely find in beautiful St. Thomas.', '<div class=\"max-w-4xl mx-auto px-4\"><p class=\"text-xl text-gray-700 mb-6 font-medium leading-relaxed\">While Magens Bay and Sapphire Beach draw crowds of cruise ship passengers and resort guests, St. Thomas harbors many lesser-known treasures that offer authentic experiences away from the tourist throngs. Here are five local favorites that will enhance your Virgin Islands adventure.</p><h2 class=\"text-2xl font-semibold text-gray-800 mt-8 mb-4\">1. Hull Bay Beach: A Surfer\'s Paradise</h2><p class=\"text-gray-600 mb-6 leading-relaxed\">Located on the island\'s north side, Hull Bay remains refreshingly undeveloped compared to St. Thomas\'s more famous beaches. This crescent-shaped cove offers:</p><ul class=\"list-disc pl-6 mb-6 text-gray-600 leading-relaxed\"><li>The island\'s best surfing when winter swells arrive (November-February)</li><li>Excellent snorkeling along the rocky edges of the bay</li><li>A laid-back local atmosphere with minimal facilities</li><li>Hull Bay Hideaway, an authentic beach bar where fishermen gather</li></ul><p class=\"text-gray-600 mb-6 leading-relaxed\">The lack of large resorts and tour buses keeps Hull Bay peaceful even during peak season. Bring your own snorkel gear, refreshments, and a desire to experience a more authentic slice of island life.</p><div class=\"my-8\"><img src=\"https://images.unsplash.com/photo-1610641234328-61fb37c86697?q=80&w=2070&auto=format&fit=crop\" alt=\"Secluded beach cove in St. Thomas\" class=\"max-w-full h-auto rounded-lg shadow-md object-cover\" /></div><h2 class=\"text-2xl font-semibold text-gray-800 mt-8 mb-4\">2. St. Peter Mountain Great House & Botanical Gardens</h2><p class=\"text-gray-600 mb-6 leading-relaxed\">While most tourists head to Paradise Point for elevated views, locals know that St. Peter Mountain Great House & Botanical Gardens offers a more serene and enriching experience. This historic estate features:</p><ul class=\"list-disc pl-6 mb-6 text-gray-600 leading-relaxed\"><li>Panoramic views of the Caribbean Sea and neighboring islands</li><li>Lush gardens with native and exotic plants</li><li>A restored 19th-century great house with historical exhibits</li><li>Opportunities for birdwatching and nature walks</li></ul><p class=\"text-gray-600 mb-6 leading-relaxed\">The quieter setting makes it ideal for a peaceful morning or afternoon, away from the hustle of Charlotte Amalie.</p><h2 class=\"text-2xl font-semibold text-gray-800 mt-8 mb-4\">3. Water Island: The Forgotten Isle</h2><p class=\"text-gray-600 mb-6 leading-relaxed\">Just a short ferry ride from St. Thomas, Water Island feels like a world apart. As the smallest of the U.S. Virgin Islands, it offers:</p><ul class=\"list-disc pl-6 mb-6 text-gray-600 leading-relaxed\"><li>Honeymoon Beach, a secluded spot perfect for swimming and picnics</li><li>Minimal development, with golf carts as the primary mode of transport</li><li>Historical ruins, including WWII-era fortifications</li><li>Weekly movie nights at Heidi’s Honeymoon Grill for a unique local experience</li></ul><p class=\"text-gray-600 mb-6 leading-relaxed\">Water Island is perfect for travelers seeking solitude and a slower pace.</p><div class=\"my-8\"><img src=\"https://images.unsplash.com/photo-1507525428034-b723cf961d3e?q=80&w=2070&auto=format&fit=crop\" alt=\"Honeymoon Beach on Water Island\" class=\"max-w-full h-auto rounded-lg shadow-md object-cover\" /></div><h2 class=\"text-2xl font-semibold text-gray-800 mt-8 mb-4\">4. Frenchtown: A Culinary and Cultural Hub</h2><p class=\"text-gray-600 mb-6 leading-relaxed\">Just west of Charlotte Amalie, Frenchtown is a charming neighborhood with deep cultural roots, originally settled by French Huguenot immigrants. Today, it’s known for:</p><ul class=\"list-disc pl-6 mb-6 text-gray-600 leading-relaxed\"><li>Top-tier restaurants like Pie Whole and Oceana, serving everything from gourmet pizza to fresh seafood</li><li>Colorful streets lined with historic buildings and vibrant murals</li><li>The French Heritage Museum, showcasing the area’s unique history</li><li>Local festivals, such as Bastille Day celebrations</li></ul><p class=\"text-gray-600 mb-6 leading-relaxed\">Visit in the evening to enjoy a meal while watching the sunset over the harbor.</p><h2 class=\"text-2xl font-semibold text-gray-800 mt-8 mb-4\">5. Lindqvist Beach: A Quiet Escape</h2><p class=\"text-gray-600 mb-6 leading-relaxed\">Tucked away on the east end of St. Thomas, Lindqvist Beach (also known as Smith Bay Beach) is a hidden gem favored by locals for its:</p><ul class=\"list-disc pl-6 mb-6 text-gray-600 leading-relaxed\"><li>Pristine white sand and calm, turquoise waters</li><li>Excellent snorkeling opportunities with vibrant coral reefs</li><li>Minimal crowds, even during peak tourist season</li><li>Shaded areas with picnic tables for a relaxed day out</li></ul><p class=\"text-gray-600 mb-6 leading-relaxed\">Bring a picnic and spend the day soaking in the tranquility of this lesser-known beach.</p><h2 class=\"text-2xl font-semibold text-gray-800 mt-8 mb-4\">Tips for Exploring St. Thomas’s Hidden Gems</h2><p class=\"text-gray-600 mb-6 leading-relaxed\">To make the most of these off-the-beaten-path spots:</p><ul class=\"list-disc pl-6 mb-6 text-gray-600 leading-relaxed\"><li>Rent a car to access remote locations like Hull Bay and Lindqvist Beach</li><li>Pack snorkel gear, sunscreen, and water, as some spots have limited facilities</li><li>Check local event calendars for festivals or special happenings in Frenchtown</li><li>Book ferry tickets to Water Island in advance during peak season</li><li>Talk to locals for insider tips—they’re often happy to share their favorite spots</li></ul><p class=\"text-gray-600 mb-6 leading-relaxed\">By venturing beyond the typical tourist trail, you’ll discover the authentic charm of St. Thomas and create memories that go beyond the postcard-perfect beaches.</p></div>', 'https://images.unsplash.com/photo-1580541631950-7282082b53ce?q=80&w=1974&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D', 'published', 3, 'Trisha Bennett', 'https://images.unsplash.com/photo-1494790108377-be9c29b29330?q=80&w=1974&auto=format&fit=crop', 'Trisha has lived in St. Thomas for over a decade and specializes in Caribbean off-the-beaten-path travel. She loves helping visitors discover the authentic sides of popular destinations.', 6, 3245, '2023-01-20 18:00:00', '2025-04-29 10:18:02', '2025-04-29 10:18:02'),
(6, 'Gambling in Las Vegas: a Beginner\'s Guide', 'gambling-in-las-vegas-a-beginners-guide', 'Learn the basics of casino games, smart betting strategies, and how to make the most of your gambling experience in Sin City.', '<div class=\"max-w-4xl mx-auto px-4\"><p class=\"text-xl text-gray-700 mb-6 font-medium leading-relaxed\">Santorini, with its iconic whitewashed villages and stunning caldera views, is a bucket-list destination. Beyond the crowded streets of Oia and Fira, discover the island’s lesser-known gems for a more authentic experience.</p><h2 class=\"text-2xl font-semibold text-gray-800 mt-8 mb-4\">Why Visit Santorini?</h2><p class=\"text-gray-600 mb-6 leading-relaxed\">Famous for its sunsets and blue-domed churches, Santorini offers more than postcard-perfect views. The island’s volcanic beaches, ancient ruins, and charming villages provide endless opportunities for exploration.</p><h2 class=\"text-2xl font-semibold text-gray-800 mt-8 mb-4\">Hidden Gems to Explore</h2><h3 class=\"text-xl font-medium text-gray-700 mt-6 mb-3\">Akrotiri Archaeological Site</h3><p class=\"text-gray-600 mb-6 leading-relaxed\">Step back in time at Akrotiri, a Minoan Bronze Age settlement preserved by volcanic ash. Unlike crowded Pompeii, this site offers a quieter experience, with well-preserved frescoes and structures.</p><div class=\"my-8\"><img src=\"https://images.unsplash.com/photo-1610048501591-7702f73c2a2b?q=80&w=2070&auto=format&fit=crop\" alt=\"Akrotiri Archaeological Site in Santorini\" class=\"max-w-full h-auto rounded-lg shadow-md object-cover\" /></div><h3 class=\"text-xl font-medium text-gray-700 mt-6 mb-3\">Pyrgos Village</h3><p class=\"text-gray-600 mb-6 leading-relaxed\">Escape the tourist crowds in Pyrgos, a hilltop village with narrow streets and traditional tavernas. Visit Kasteli Castle for panoramic views and enjoy local wines at a family-run winery.</p><h3 class=\"text-xl font-medium text-gray-700 mt-6 mb-3\">Red Beach</h3><p class=\"text-gray-600 mb-6 leading-relaxed\">While Santorini’s black sand beaches are famous, Red Beach’s dramatic crimson cliffs offer a unique contrast. Accessible by a short hike, it’s perfect for snorkeling and photography.</p><div class=\"my-8\"><img src=\"https://images.unsplash.com/photo-1507272930787-5fd1a2e70386?q=80&w=2070&auto=format&fit=crop\" alt=\"Red Beach in Santorini\" class=\"max-w-full h-auto rounded-lg shadow-md object-cover\" /></div><h2 class=\"text-2xl font-semibold text-gray-800 mt-8 mb-4\">Tips for Visiting Santorini</h2><p class=\"text-gray-600 mb-6 leading-relaxed\">To make the most of your trip:</p><ul class=\"list-disc pl-6 mb-6 text-gray-600 leading-relaxed\"><li>Visit in spring or fall to avoid summer crowds</li><li>Rent a scooter to explore remote villages</li><li>Book accommodations in quieter areas like Imerovigli</li><li>Reserve sunset dinner spots in advance</li></ul><p class=\"text-gray-600 mb-6 leading-relaxed\">Santorini’s hidden charms await those willing to venture beyond the usual tourist trail. Plan your escape today for an unforgettable Greek adventure.</p></div>', 'https://images.unsplash.com/photo-1518639192441-8fce0a366e2e?q=80&w=2071&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D', 'published', 2, 'Daniel Morgan', 'https://images.unsplash.com/photo-1564564321837-a57b7070ac4f?q=80&w=2076&auto=format&fit=crop', 'Daniel is a former casino dealer who now works as a travel writer specializing in Las Vegas and gaming destinations. He aims to help first-time visitors navigate the casino experience with confidence.', 9, 7834, '2023-01-15 18:00:00', '2025-04-29 10:18:02', '2025-04-29 10:18:02'),
(7, '10 Essential Travel Apps for Your Next Vacation', '10-essential-travel-apps-for-your-next-vacation', 'Transform your smartphone into the ultimate travel companion with these must-have apps that will help you plan, navigate, and enjoy your vacation.', '<div class=\"max-w-4xl mx-auto px-4\"><p class=\"text-xl text-gray-700 mb-6 font-medium leading-relaxed\">New Orleans is a culinary paradise, blending Creole, Cajun, and international flavors. From beignets to gumbo, here’s how to savor the city’s vibrant food scene.</p><h2 class=\"text-2xl font-semibold text-gray-800 mt-8 mb-4\">Why New Orleans for Foodies?</h2><p class=\"text-gray-600 mb-6 leading-relaxed\">The city’s diverse heritage creates a unique culinary landscape. Whether you’re dining in historic eateries or modern bistros, every bite tells a story.</p><h2 class=\"text-2xl font-semibold text-gray-800 mt-8 mb-4\">Must-Try Dishes and Where to Find Them</h2><h3 class=\"text-xl font-medium text-gray-700 mt-6 mb-3\">Beignets at Café du Monde</h3><p class=\"text-gray-600 mb-6 leading-relaxed\">No trip to New Orleans is complete without powdered sugar-dusted beignets at Café du Monde. Pair them with chicory coffee for a classic experience.</p><div class=\"my-8\"><img src=\"https://images.unsplash.com/photo-1515443961218-a51367888e4b?q=80&w=2070&auto=format&fit=crop\" alt=\"Beignets at Café du Monde\" class=\"max-w-full h-auto rounded-lg shadow-md object-cover\" /></div><h3 class=\"text-xl font-medium text-gray-700 mt-6 mb-3\">Gumbo at Dooky Chase’s</h3><p class=\"text-gray-600 mb-6 leading-relaxed\">Savor soul-warming gumbo at Dooky Chase’s, a historic restaurant known for its Creole cuisine and civil rights history. The seafood gumbo is a standout.</p><h3 class=\"text-xl font-medium text-gray-700 mt-6 mb-3\">Po’ Boys at Parkway Bakery</h3><p class=\"text-gray-600 mb-6 leading-relaxed\">For a hearty sandwich, head to Parkway Bakery for a shrimp po’ boy. This local favorite offers generous portions and a casual vibe.</p><div class=\"my-8\"><img src=\"https://images.unsplash.com/photo-1611691137799-243d9c2f4d1f?q=80&w=2070&auto=format&fit=crop\" alt=\"Shrimp po’ boy in New Orleans\" class=\"max-w-full h-auto rounded-lg shadow-md object-cover\" /></div><h2 class=\"text-2xl font-semibold text-gray-800 mt-8 mb-4\">Foodie Tips for New Orleans</h2><p class=\"text-gray-600 mb-6 leading-relaxed\">To enjoy the culinary scene:</p><ul class=\"list-disc pl-6 mb-6 text-gray-600 leading-relaxed\"><li>Book dinner reservations at popular spots like Commander’s Palace</li><li>Explore the French Market for local snacks and spices</li><li>Join a food tour to sample multiple dishes</li><li>Visit during the New Orleans Food & Wine Experience in June</li></ul><p class=\"text-gray-600 mb-6 leading-relaxed\">New Orleans’ food scene is a feast for the senses. Plan your culinary adventure and taste the city’s soul.</p></div>', 'https://images.unsplash.com/photo-1526080676457-4544bf0ebba9?q=80&w=2070&auto=format&fit=crop', 'published', 2, 'Alex Rivera', 'https://images.unsplash.com/photo-1539571696357-5a69c17a67c6?q=80&w=1974&auto=format&fit=crop', 'Alex is a digital nomad and tech enthusiast who has traveled to over 50 countries. He specializes in finding ways to use technology to enhance travel experiences without letting it become a distraction.', 7, 6329, '2023-08-04 18:00:00', '2025-04-29 10:18:02', '2025-04-29 10:18:02'),
(8, 'Family Travel: Making Memories Without Losing Your Mind', 'family-travel-making-memories-without-losing-your-mind', 'Practical strategies for planning and enjoying stress-free family vacations that everyone will remember fondly—including the parents!', '<div class=\"max-w-4xl mx-auto px-4\"><p class=\"text-xl text-gray-700 mb-6 font-medium leading-relaxed\">Banff, nestled in the Canadian Rockies, is a winter wonderland perfect for skiers, snowboarders, and nature lovers. Discover why Banff should be your next cold-weather getaway.</p><h2 class=\"text-2xl font-semibold text-gray-800 mt-8 mb-4\">Why Choose Banff?</h2><p class=\"text-gray-600 mb-6 leading-relaxed\">With its snow-capped peaks, frozen lakes, and cozy lodges, Banff offers breathtaking scenery and endless outdoor activities, all wrapped in Canadian hospitality.</p><h2 class=\"text-2xl font-semibold text-gray-800 mt-8 mb-4\">Top Winter Activities</h2><h3 class=\"text-xl font-medium text-gray-700 mt-6 mb-3\">Skiing at Banff Sunshine Village</h3><p class=\"text-gray-600 mb-6 leading-relaxed\">Banff Sunshine Village boasts powdery slopes and stunning views. With runs for all skill levels, it’s a skier’s paradise.</p><div class=\"my-8\"><img src=\"https://images.unsplash.com/photo-1517404215738-15263e9f9178?q=80&w=2070&auto=format&fit=crop\" alt=\"Skiing at Banff Sunshine Village\" class=\"max-w-full h-auto rounded-lg shadow-md object-cover\" /></div><h3 class=\"text-xl font-medium text-gray-700 mt-6 mb-3\">Ice Skating on Lake Louise</h3><p class=\"text-gray-600 mb-6 leading-relaxed\">Skate on the frozen surface of Lake Louise, surrounded by towering mountains. The Fairmont Chateau offers skate rentals and hot cocoa.</p><h3 class=\"text-xl font-medium text-gray-700 mt-6 mb-3\">Johnston Canyon Ice Walk</h3><p class=\"text-gray-600 mb-6 leading-relaxed\">Hike through Johnston Canyon to see frozen waterfalls and ice formations. Guided tours provide insights into the area’s geology.</p><div class=\"my-8\"><img src=\"https://images.unsplash.com/photo-1487734092099-7b3e283f7f7b?q=80&w=2070&auto=format&fit=crop\" alt=\"Johnston Canyon ice formations\" class=\"max-w-full h-auto rounded-lg shadow-md object-cover\" /></div><h2 class=\"text-2xl font-semibold text-gray-800 mt-8 mb-4\">Winter Travel Tips</h2><p class=\"text-gray-600 mb-6 leading-relaxed\">To make your Banff trip unforgettable:</p><ul class=\"list-disc pl-6 mb-6 text-gray-600 leading-relaxed\"><li>Book accommodations early, especially for February’s peak season</li><li>Pack layered clothing for unpredictable weather</li><li>Reserve spots for guided tours like dog sledding</li><li>Visit Banff’s hot springs for a relaxing soak</li></ul><p class=\"text-gray-600 mb-6 leading-relaxed\">Banff’s winter magic is calling. Plan your snowy escape for a season of adventure and beauty.</p></div>', 'https://images.unsplash.com/photo-1541447237128-f4cac6138fbe?q=80&w=1974&auto=format&fit=crop', 'published', 4, 'Rachel Thompson', 'https://images.unsplash.com/photo-1489424731084-a5d8b219a5bb?q=80&w=1974&auto=format&fit=crop', 'Rachel is a family travel expert and mother of three who has visited 27 countries with her children. She combines practical parenting knowledge with a passion for creating meaningful travel experiences for families.', 8, 5487, '2023-07-13 18:00:00', '2025-04-29 10:18:02', '2025-04-29 10:18:02');
INSERT INTO `blogs` (`id`, `title`, `slug`, `excerpt`, `content`, `featured_image`, `status`, `category_id`, `author`, `author_image`, `author_bio`, `read_time`, `views`, `published_at`, `created_at`, `updated_at`) VALUES
(9, 'Sustainable Travel: How to Explore the World While Protecting It', 'sustainable-travel-how-to-explore-the-world-while-protecting-it', 'Practical tips for reducing your environmental impact, supporting local communities, and making more ethical travel choices without sacrificing amazing experiences.', '<div class=\"max-w-4xl mx-auto px-4\"><p class=\"text-xl text-gray-700 mb-6 font-medium leading-relaxed\">Marrakech, Morocco’s vibrant heart, is a sensory overload of colors, sounds, and flavors. From bustling souks to serene riads, here’s how to experience its cultural treasures.</p><h2 class=\"text-2xl font-semibold text-gray-800 mt-8 mb-4\">Why Marrakech?</h2><p class=\"text-gray-600 mb-6 leading-relaxed\">Marrakech blends ancient traditions with modern energy, offering travelers a chance to explore historic palaces, lively markets, and tranquil gardens.</p><h2 class=\"text-2xl font-semibold text-gray-800 mt-8 mb-4\">Cultural Highlights</h2><h3 class=\"text-xl font-medium text-gray-700 mt-6 mb-3\">Jemaa el-Fnaa Square</h3><p class=\"text-gray-600 mb-6 leading-relaxed\">The heart of Marrakech, Jemaa el-Fnaa is a UNESCO site filled with snake charmers, storytellers, and food stalls. Visit at dusk for the liveliest atmosphere.</p><div class=\"my-8\"><img src=\"https://images.unsplash.com/photo-1518684079-3c830dcef090?q=80&w=2070&auto=format&fit=crop\" alt=\"Jemaa el-Fnaa Square in Marrakech\" class=\"max-w-full h-auto rounded-lg shadow-md object-cover\" /></div><h3 class=\"text-xl font-medium text-gray-700 mt-6 mb-3\">Bahia Palace</h3><p class=\"text-gray-600 mb-6 leading-relaxed\">Marvel at the intricate tilework and courtyards of Bahia Palace, a 19th-century masterpiece. Early morning visits avoid the crowds.</p><h3 class=\"text-xl font-medium text-gray-700 mt-6 mb-3\">Majorelle Garden</h3><p class=\"text-gray-600 mb-6 leading-relaxed\">Find peace in the vibrant blue Majorelle Garden, once owned by Yves Saint-Laurent. The adjacent Berber Museum is a hidden gem.</p><div class=\"my-8\"><img src=\"https://images.unsplash.com/photo-1595436418959-30a05ed3f068?q=80&w=2070&auto=format&fit=crop\" alt=\"Majorelle Garden in Marrakech\" class=\"max-w-full h-auto rounded-lg shadow-md object-cover\" /></div><h2 class=\"text-2xl font-semibold text-gray-800 mt-8 mb-4\">Tips for Visiting Marrakech</h2><p class=\"text-gray-600 mb-6 leading-relaxed\">To navigate the city like a pro:</p><ul class=\"list-disc pl-6 mb-6 text-gray-600 leading-relaxed\"><li>Stay in a riad for an authentic experience</li><li>Haggle politely in the souks</li><li>Respect local customs, especially during Ramadan</li><li>Try street food like tagine or pastilla</li></ul><p class=\"text-gray-600 mb-6 leading-relaxed\">Marrakech is a cultural adventure waiting to be explored. Book your trip to discover its timeless allure.</p></div>', 'https://images.unsplash.com/photo-1552733407-5d5c46c3bb3b?q=80&w=1980&auto=format&fit=crop', 'published', 2, 'Maya Peterson', 'https://images.unsplash.com/photo-1580489944761-15a19d654956?q=80&w=1922&auto=format&fit=crop', 'Maya is an environmental scientist and sustainable travel advocate who has spent the past decade exploring how tourism can benefit both communities and ecosystems. She has worked with eco-lodges and sustainable tour operators across five continents.', 9, 4125, '2023-06-21 18:00:00', '2025-04-29 10:18:02', '2025-04-29 10:18:02');

-- --------------------------------------------------------

--
-- Table structure for table `blog_categories`
--

CREATE TABLE `blog_categories` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `blog_categories`
--

INSERT INTO `blog_categories` (`id`, `name`, `slug`, `created_at`, `updated_at`) VALUES
(1, 'Destinations', 'destinations', '2025-04-29 10:13:06', '2025-04-29 10:13:06'),
(2, 'Travel Tips', 'travel-tips', '2025-04-29 10:13:06', '2025-04-29 10:13:06'),
(3, 'Hidden Gems', 'hidden-gems', '2025-04-29 10:13:06', '2025-04-29 10:13:06'),
(4, 'Experiences', 'experiences', '2025-04-29 10:13:06', '2025-04-29 10:13:06'),
(6, 'Monster Traveler', 'monster-traveler', '2025-05-30 12:03:32', '2025-05-30 12:03:32');

-- --------------------------------------------------------

--
-- Table structure for table `blog_tag`
--

CREATE TABLE `blog_tag` (
  `id` bigint UNSIGNED NOT NULL,
  `blog_id` bigint UNSIGNED NOT NULL,
  `tag_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `blog_tag`
--

INSERT INTO `blog_tag` (`id`, `blog_id`, `tag_id`, `created_at`, `updated_at`) VALUES
(7, 13, 7, NULL, NULL),
(8, 13, 8, NULL, NULL),
(9, 13, 9, NULL, NULL),
(10, 14, 2, NULL, NULL),
(11, 14, 3, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `bundles`
--

CREATE TABLE `bundles` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `short_description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `original_price` decimal(10,2) NOT NULL,
  `rating` decimal(3,2) NOT NULL DEFAULT '0.00',
  `reviews_count` int NOT NULL DEFAULT '0',
  `card_image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `hero_image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gallery_main_image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gallery` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `features` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active'
) ;

--
-- Dumping data for table `bundles`
--

INSERT INTO `bundles` (`id`, `name`, `slug`, `short_description`, `description`, `price`, `original_price`, `rating`, `reviews_count`, `card_image`, `hero_image`, `gallery_main_image`, `gallery`, `features`, `created_at`, `updated_at`, `status`) VALUES
(1, 'Best Beaches Bundle', 'best-beaches-bundle', 'Explore the world\'s most beautiful beaches', 'Experience the ultimate beach vacation with our Best Beaches Bundle! Enjoy pristine white sand beaches in Punta Cana and the classic American beach experience in Myrtle Beach - all in one amazing package. This bundle includes luxurious accommodations, beach activities, and our signature white glove service to ensure your vacation is perfect from start to finish.', 998.00, 1599.00, 4.80, 2172, 'https://images.unsplash.com/photo-1505142468610-359e7d316be0?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D', 'https://images.unsplash.com/photo-1548574505-5e239809ee19?q=80&w=2064&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D', 'https://images.unsplash.com/photo-1519046904884-53103b34b206?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D', '[\"https:\\/\\/images.unsplash.com\\/photo-1519046904884-53103b34b206?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D\",\"https:\\/\\/images.unsplash.com\\/photo-1535262412227-85541e910204?q=80&w=2069&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D\",\"https:\\/\\/images.unsplash.com\\/photo-1501950183564-3c8ac97d08f0?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D\",\"https:\\/\\/images.unsplash.com\\/photo-1642425146609-6c8ff4589d18?q=80&w=1932&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D\",\"https:\\/\\/images.unsplash.com\\/photo-1515404929826-76fff9fef6fe?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D\"]', '[\"All-Inclusive Options\",\"White Sand Beaches\",\"Family Friendly\",\"18 Months to Book\"]', '2025-04-29 10:25:27', '2025-05-02 12:57:29', 'active'),
(2, 'Exciting Live Show Bundle', 'exciting-live-show-bundle', 'Experience the best entertainment in Las Vegas and Branson', 'Get ready for an unforgettable entertainment experience with our Exciting Live Show Bundle! Enjoy the dazzling shows and vibrant nightlife of Las Vegas along with the family-friendly live entertainment capital of Branson, Missouri. This bundle includes accommodations in both destinations, show tickets, and our signature white glove service to ensure your entertainment vacation is perfect from start to finish.', 498.00, 899.00, 4.70, 1842, 'https://images.unsplash.com/photo-1597910037310-7dd8ddb93e24?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D', 'https://images.unsplash.com/photo-1635885648209-b30a48f4304e?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D', 'https://images.unsplash.com/photo-1605833556294-ea5c7a74f57d?q=80&w=2074&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D', '[\"https:\\/\\/images.unsplash.com\\/photo-1605833556294-ea5c7a74f57d?q=80&w=2074&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D\",\"https:\\/\\/images.unsplash.com\\/photo-1600616367651-eac653b827c6?q=80&w=2067&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D\",\"https:\\/\\/images.unsplash.com\\/photo-1583766395091-2eb9994ed094?q=80&w=2064&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D\",\"https:\\/\\/images.unsplash.com\\/photo-1560651471-d7fca5abfd5f?q=80&w=1974&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D\",\"https:\\/\\/images.unsplash.com\\/photo-1561501900-3701fa6a0864?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D\"]', '[\"Live Entertainment\",\"Family Friendly\",\"Both Adult & Family Shows\",\"18 Months to Book\"]', '2025-04-29 10:25:27', '2025-04-29 10:25:27', 'active'),
(3, 'Caribbean Getaway Bundle', 'caribbean-getaway-bundle', 'Experience the beauty of the Caribbean\'s top destinations', 'Escape to paradise with our Caribbean Getaway Bundle! Experience the stunning beaches and vibrant culture of Cancun, Mexico, and the breathtaking beauty and hospitality of the Dominican Republic. This incredible bundle includes luxurious all-inclusive accommodations, beautiful beaches, and our signature white glove service to ensure your tropical vacation is perfect from start to finish.', 1198.00, 1999.00, 4.90, 1458, 'https://images.unsplash.com/photo-1596394516093-501ba68a0ba6?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D', 'https://images.unsplash.com/photo-1510414842594-a61c69b5ae57?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D', 'https://images.unsplash.com/photo-1545579133-99bb5ab189bd?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D', '[\"https:\\/\\/images.unsplash.com\\/photo-1545579133-99bb5ab189bd?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D\",\"https:\\/\\/images.unsplash.com\\/photo-1510414842594-a61c69b5ae57?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D\",\"https:\\/\\/images.unsplash.com\\/photo-1500759285222-a95626b934cb?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D\",\"https:\\/\\/images.unsplash.com\\/photo-1596394516093-501ba68a0ba6?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D\",\"https:\\/\\/images.unsplash.com\\/photo-1720016003105-9023537d10cc?q=80&w=1971&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D\"]', '[\"All-Inclusive Resorts\",\"Pristine Beaches\",\"Tropical Paradise\",\"18 Months to Book\"]', '2025-04-29 10:25:27', '2025-04-29 10:25:27', 'active'),
(4, 'Mountain Escape Bundle', 'mountain-escape-bundle', 'Discover serene mountain retreats in Colorado and Banff', 'Unwind in nature with our Mountain Escape Bundle! Experience the breathtaking Rocky Mountains in Aspen, Colorado, and the stunning alpine scenery of Banff, Canada. This bundle includes cozy accommodations, outdoor activities like hiking and skiing, and our signature white glove service for a perfect mountain getaway.', 1098.00, 1799.00, 4.80, 1289, 'https://images.unsplash.com/photo-1600585154340-be6161a56a0c?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3', 'https://images.unsplash.com/photo-1506905925346-21bda4d32df4?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3', 'https://images.unsplash.com/photo-1573422579905-8a6a80a5aa57?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D', '[\"https:\\/\\/images.unsplash.com\\/photo-1710300921395-35ee7b6e5fbe?q=80&w=1974&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D\",\"https:\\/\\/images.unsplash.com\\/photo-1519681393784-d120267933ba?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3\",\"https:\\/\\/images.unsplash.com\\/photo-1464822759023-fed622ff2c3b?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3\",\"https:\\/\\/images.unsplash.com\\/photo-1496516409069-f135ee19b2eb?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D\",\"https:\\/\\/images.unsplash.com\\/photo-1507525428034-b723cf961d3e?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3\"]', '[\"Skiing and Hiking\",\"Cozy Cabins\",\"Scenic Views\",\"18 Months to Book\"]', '2025-04-29 10:25:27', '2025-04-29 10:25:27', 'active'),
(5, 'Cultural Explorer Bundle', 'cultural-explorer-bundle', 'Immerse yourself in the history and culture of Rome and Kyoto', 'Embark on a journey through time with our Cultural Explorer Bundle! Discover the ancient wonders of Rome, Italy, and the timeless traditions of Kyoto, Japan. This bundle includes historic accommodations, guided cultural tours, and our signature white glove service for an enriching vacation.', 1498.00, 2299.00, 4.90, 987, 'https://images.unsplash.com/photo-1664485033472-b98b55632fc3?q=80&w=1932&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D', 'https://images.unsplash.com/photo-1664218018556-0bf1297c7653?q=80&w=1932&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D', 'https://images.unsplash.com/photo-1707474893587-a37a9cf1b555?q=80&w=1974&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D', '[\"https:\\/\\/images.unsplash.com\\/photo-1707474893587-a37a9cf1b555?q=80&w=1974&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D\",\"https:\\/\\/images.unsplash.com\\/photo-1664218018648-cf24224ee376?q=80&w=1932&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D\",\"https:\\/\\/images.unsplash.com\\/photo-1664218018556-0bf1297c7653?q=80&w=1932&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D\",\"https:\\/\\/images.unsplash.com\\/photo-1547471080-7cc2caa01a7e?q=80&w=2071&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D\",\"https:\\/\\/images.unsplash.com\\/photo-1543067296-88e91061c509?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D\"]', '[\"Guided Cultural Tours\",\"Historic Sites\",\"Local Cuisine\",\"18 Months to Book\"]', '2025-04-29 10:25:27', '2025-04-29 10:25:27', 'active'),
(6, 'Safari Adventure Bundle', 'safari-adventure-bundle', 'Embark on thrilling safaris in Kenya and South Africa', 'Experience the wild with our Safari Adventure Bundle! Journey through the iconic savannas of Kenya’s Maasai Mara and South Africa’s Kruger National Park. This bundle includes luxury safari lodges, guided game drives, and our signature white glove service for an unforgettable wildlife adventure.', 2498.00, 3499.00, 4.95, 654, 'https://images.unsplash.com/photo-1516426122078-c23e76319801?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3', 'https://images.unsplash.com/photo-1504173010664-32509aeebb62?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3', 'https://images.unsplash.com/photo-1602410125631-7e736e36797c?q=80&w=1933&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D', '[\"https:\\/\\/images.unsplash.com\\/photo-1602410125631-7e736e36797c?q=80&w=1933&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D\",\"https:\\/\\/images.unsplash.com\\/photo-1516426122078-c23e76319801?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3\",\"https:\\/\\/images.unsplash.com\\/photo-1504173010664-32509aeebb62?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3\",\"https:\\/\\/images.unsplash.com\\/photo-1602410141957-ee70b4739066?q=80&w=1974&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D\",\"https:\\/\\/images.unsplash.com\\/photo-1602410132231-9e6c692e02db?q=80&w=1974&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D\"]', '[\"Guided Safari Tours\",\"Luxury Lodges\",\"Big Five Wildlife\",\"18 Months to Book\"]', '2025-04-29 10:25:27', '2025-04-29 10:25:27', 'active'),
(7, 'Island Paradise Bundle', 'island-paradise-bundle', 'Relax in the tropical havens of Bora Bora and the Maldives', 'Escape to pure bliss with our Island Paradise Bundle! Discover the overwater bungalows and turquoise lagoons of Bora Bora, French Polynesia, and the pristine coral reefs of the Maldives. This bundle includes luxurious island accommodations, water-based activities, and our signature white glove service for an idyllic tropical retreat.', 2298.00, 3199.00, 4.90, 892, 'https://images.unsplash.com/photo-1557607138-af66a2f64af6?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D', 'https://images.unsplash.com/photo-1557607138-af66a2f64af6?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D', 'https://images.unsplash.com/photo-1557607138-af66a2f64af6?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D', '[\"https:\\/\\/images.unsplash.com\\/photo-1557606091-b7bb450b4d29?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D\",\"https:\\/\\/images.unsplash.com\\/photo-1669517270484-df54ad8d54c8?q=80&w=1974&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D\",\"https:\\/\\/images.unsplash.com\\/photo-1509233725247-49e657c54213?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3\",\"https:\\/\\/images.unsplash.com\\/photo-1650509570477-bb1da37b08b0?q=80&w=2071&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D\",\"https:\\/\\/images.unsplash.com\\/photo-1507525428034-b723cf961d3e?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3\"]', '[\"Overwater Bungalows\",\"Snorkeling and Diving\",\"Private Beaches\",\"18 Months to Book\"]', '2025-04-29 10:25:27', '2025-04-29 10:25:27', 'active'),
(8, 'City Lights Bundle', 'city-lights-bundle', 'Explore the vibrant urban scenes of New York City and Tokyo', 'Dive into the energy of the world’s greatest cities with our City Lights Bundle! Experience the iconic skyline and cultural diversity of New York City, USA, and the futuristic charm of Tokyo, Japan. This bundle includes premium accommodations, city tours, and our signature white glove service for an unforgettable urban adventure.', 1298.00, 1999.00, 4.70, 1345, 'https://images.unsplash.com/photo-1496442226666-8d4d0e62e6e9?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3', 'https://images.unsplash.com/photo-1507608869274-d3177c8bb4c7?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3', 'https://images.unsplash.com/photo-1518391846015-55a9cc003b25?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3', '[\"https:\\/\\/images.unsplash.com\\/photo-1518391846015-55a9cc003b25?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3\",\"https:\\/\\/images.unsplash.com\\/photo-1496442226666-8d4d0e62e6e9?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3\",\"https:\\/\\/images.unsplash.com\\/photo-1507608869274-d3177c8bb4c7?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3\",\"https:\\/\\/images.unsplash.com\\/photo-1500916434205-0c77489c6cf7?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3\",\"https:\\/\\/images.unsplash.com\\/photo-1521072100039-6052edf01606?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D\"]', '[\"City Tours\",\"Cultural Attractions\",\"Vibrant Nightlife\",\"18 Months to Book\"]', '2025-04-29 10:25:27', '2025-04-29 10:25:27', 'active'),
(9, 'Wine Country Retreat Bundle', 'wine-country-retreat-bundle', 'Savor the flavors of Tuscany and Napa Valley', 'Indulge in the art of winemaking with our Wine Country Retreat Bundle! Explore the rolling vineyards of Tuscany, Italy, and the world-famous wineries of Napa Valley, California. This bundle includes charming accommodations, wine tastings, and our signature white glove service for a refined culinary escape.', 1398.00, 2099.00, 4.80, 1103, 'https://images.unsplash.com/photo-1715443129920-80df81a071b2?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D', 'https://images.unsplash.com/photo-1504948672607-155c6a87747c?q=80&w=2131&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D', 'https://images.unsplash.com/photo-1715443129920-80df81a071b2?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D', '[\"https:\\/\\/images.unsplash.com\\/photo-1717170649234-53410d9b6c1b?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D\",\"https:\\/\\/images.unsplash.com\\/photo-1618825908635-d2ffd46cc207?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D\",\"https:\\/\\/images.unsplash.com\\/photo-1647359287844-e3f49721617a?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D\",\"https:\\/\\/images.unsplash.com\\/photo-1522771739844-6a9f6d5f14af?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3\",\"https:\\/\\/images.unsplash.com\\/photo-1659831439399-efce3d14426c?q=80&w=1974&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D\"]', '[\"Wine Tastings\",\"Scenic Vineyards\",\"Gourmet Dining\",\"18 Months to Book\"]', '2025-04-29 10:25:27', '2025-04-29 10:25:27', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `bundle_extras`
--

CREATE TABLE `bundle_extras` (
  `id` bigint UNSIGNED NOT NULL,
  `bundle_id` bigint UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bundle_extras`
--

INSERT INTO `bundle_extras` (`id`, `bundle_id`, `title`, `description`, `image`, `created_at`, `updated_at`) VALUES
(1, 1, 'Bonus Week Trip', 'You\'ll also receive a FREE 8 Day, 7 Night Bonus MyTravel Week Trip which can be used at select destinations across the United States, Caribbean, and Mexico. This bonus can be used for a third vacation or to extend your stay at one of your bundle destinations, giving you even more time to relax and enjoy your getaway!', 'https://images.unsplash.com/photo-1540541338287-41700207dee6?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D', '2025-04-29 10:25:27', '2025-05-26 12:22:04'),
(2, 2, 'Bonus Week Trip', 'You\'ll also receive a FREE 8 Day, 7 Night Bonus MyTravel Week Trip which can be used at select destinations across the United States. This bonus can be used for a third vacation or to extend your stay at one of your bundle destinations!', 'https://images.unsplash.com/photo-1540541338287-41700207dee6?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D', '2025-04-29 10:25:27', '2025-04-29 10:25:27'),
(3, 3, 'Bonus Week Trip', 'You\'ll also receive a FREE 8 Day, 7 Night Bonus MyTravel Week Trip which can be used at select destinations across the United States, Caribbean, and Mexico. This bonus can be used for a third vacation or to extend your stay at one of your bundle destinations!', 'https://images.unsplash.com/photo-1540541338287-41700207dee6?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D', '2025-04-29 10:25:27', '2025-04-29 10:25:27'),
(4, 4, 'Bonus Week Trip', 'Receive a FREE 8 Day, 7 Night Bonus MyTravel Week Trip to select destinations across the United States and Canada. Use it for a third vacation or to extend your mountain adventure!', 'https://images.unsplash.com/photo-1507525428034-b723cf961d3e?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3', '2025-04-29 10:25:27', '2025-04-29 10:25:27'),
(5, 5, 'Bonus Week Trip', 'Receive a FREE 8 Day, 7 Night Bonus MyTravel Week Trip to select destinations across Europe and Asia. Use it for a third vacation or to extend your cultural journey!', 'https://images.unsplash.com/photo-1664218018556-0bf1297c7653?q=80&w=1932&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D', '2025-04-29 10:25:27', '2025-04-29 10:25:27'),
(6, 6, 'Bonus Week Trip', 'Receive a FREE 8 Day, 7 Night Bonus MyTravel Week Trip to select destinations across Africa and the Middle East. Use it for a third vacation or to extend your safari adventure!', 'https://images.unsplash.com/photo-1602410132231-9e6c692e02db?q=80&w=1974&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D', '2025-04-29 10:25:27', '2025-04-29 10:25:27'),
(7, 7, 'Bonus Week Trip', 'Receive a FREE 8 Day, 7 Night Bonus MyTravel Week Trip to select destinations across the Pacific and Indian Oceans. Use it for a third vacation or to extend your island getaway!', 'https://images.unsplash.com/photo-1509233725247-49e657c54213?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3', '2025-04-29 10:25:27', '2025-04-29 10:25:27'),
(8, 8, 'Bonus Week Trip', 'Receive a FREE 8 Day, 7 Night Bonus MyTravel Week Trip to select destinations across North America and Asia. Use it for a third vacation or to extend your city adventure!', 'https://images.unsplash.com/photo-1500916434205-0c77489c6cf7?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3', '2025-04-29 10:25:27', '2025-04-29 10:25:27'),
(9, 9, 'Bonus Week Trip', 'Receive a FREE 8 Day, 7 Night Bonus MyTravel Week Trip to select destinations across Europe and North America. Use it for a third vacation or to extend your wine country retreat!', 'https://images.unsplash.com/photo-1599805215005-728a143ba6c3?q=80&w=2154&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D', '2025-04-29 10:25:27', '2025-04-29 10:25:27');

-- --------------------------------------------------------

--
-- Table structure for table `bundle_types`
--

CREATE TABLE `bundle_types` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `price` decimal(10,2) NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `features` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ;

--
-- Dumping data for table `bundle_types`
--

INSERT INTO `bundle_types` (`id`, `name`, `description`, `price`, `slug`, `active`, `features`, `image`, `created_at`, `updated_at`) VALUES
(1, 'Domestic', 'Select any two different destinations to create your custom domestic travel experience.', 598.00, 'domestic', 1, '[\"Two 5 Day \\/ 4 Night Stays To Top Domestic Destinations\",\"1x Signature 8 Day \\/ 7 Night Monster Week Trip\",\"White Glove Service\"]', 'https://images.unsplash.com/photo-1649686887571-afa47f5428e4?q=80&w=2071&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D', '2025-04-29 10:08:12', '2025-05-21 21:25:31'),
(2, 'Combination', 'Select one domestic destination and one international destination to create your personalized travel bundle.', 898.00, 'combination', 1, '[\"One 5 Day \\/ 4 Night Stay To A Top Domestic Destination\",\"One 6 Day \\/ 5 Night Stay To Top International Destination\",\"1x Signature 8 Day \\/ 7 Night Monster Week Trip\",\"White Glove Service\"]', 'https://images.unsplash.com/photo-1477959858617-67f85cf4f1df?q=80&w=2144&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D', '2025-04-29 10:08:12', '2025-05-21 21:25:03'),
(3, 'International', 'Create your dream international vacation by selecting two incredible destinations.', 1098.00, 'international', 1, '[\"Two 6 Day \\/ 5 Night Stays To Top International Destinations\",\"1x Signature 8 Day \\/ 7 Night Monster Week Trip\",\"White Glove Service\"]', 'https://images.unsplash.com/photo-1559628233-100c798642d4?q=80&w=2035&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D', '2025-04-29 10:08:12', '2025-05-02 16:18:42');

-- --------------------------------------------------------

--
-- Table structure for table `captcha_settings`
--

CREATE TABLE `captcha_settings` (
  `id` bigint UNSIGNED NOT NULL,
  `site_key` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `secret_key` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `enabled` tinyint(1) NOT NULL DEFAULT '0',
  `enable_on_login` tinyint(1) NOT NULL DEFAULT '1',
  `enable_on_register` tinyint(1) NOT NULL DEFAULT '1',
  `enable_on_contact` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `captcha_settings`
--

INSERT INTO `captcha_settings` (`id`, `site_key`, `secret_key`, `enabled`, `enable_on_login`, `enable_on_register`, `enable_on_contact`, `created_at`, `updated_at`) VALUES
(2, '0x4AAAAAABdQKs7RAB8PR5mz', '0x4AAAAAABdQKrlqGi-vqhS_2oDNZpzGQ_o', 1, 1, 1, 1, '2025-05-20 02:35:57', '2025-05-20 06:02:49');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` bigint UNSIGNED NOT NULL,
  `blog_id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `author` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `author_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `blog_id`, `user_id`, `author`, `author_image`, `content`, `created_at`, `updated_at`) VALUES
(1, 2, 1, 'Md Salim', NULL, 'nice', '2025-04-30 00:00:46', '2025-04-30 00:00:46'),
(2, 1, 1, 'Mst Hosne Ara Rubi', NULL, 'Nice', '2025-05-26 12:42:46', '2025-05-26 12:42:46'),
(3, 14, 1, 'Monster Traveler', NULL, 'Nice', '2025-05-30 12:01:50', '2025-05-30 12:01:50');

-- --------------------------------------------------------

--
-- Table structure for table `contact_settings`
--

CREATE TABLE `contact_settings` (
  `id` bigint UNSIGNED NOT NULL,
  `service_number` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sales_office_number` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `po_box_address` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `work_hours_weekday` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `work_hours_weekend` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contact_email` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contact_recipient_email` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `mail_mailer` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mail_host` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mail_port` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mail_username` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mail_password` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mail_encryption` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mail_from_address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mail_from_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `contact_settings`
--

INSERT INTO `contact_settings` (`id`, `service_number`, `sales_office_number`, `po_box_address`, `work_hours_weekday`, `work_hours_weekend`, `contact_email`, `contact_recipient_email`, `created_at`, `updated_at`, `mail_mailer`, `mail_host`, `mail_port`, `mail_username`, `mail_password`, `mail_encryption`, `mail_from_address`, `mail_from_name`) VALUES
(1, 'CALL US AT: 844-648', 'CALL US AT: 888-644', 'MyTravel Reservations GroupPO BOX 14134MYRTLE BEACH, SC 29587', 'MON-FRI: 8 AM - 12 AM (MIDNIGHT) EST', 'SAT-SUN: 9 AM - 7 PM EST', 'marketing@trypbug.com', 'noreply@trypbug.com', NULL, '2025-05-30 12:24:04', 'smtp', 'smtp.hostinger.com', '465', 'noreply@freelancerhasib.com', 'Panna@8411', 'tls', 'noreply@freelancerhasib.com', 'MyTravel');

-- --------------------------------------------------------

--
-- Table structure for table `contact_submissions`
--

CREATE TABLE `contact_submissions` (
  `id` bigint UNSIGNED NOT NULL,
  `first_name` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `last_name` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `phone` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `package_holder` enum('yes','no') COLLATE utf8mb4_general_ci NOT NULL,
  `message` text COLLATE utf8mb4_general_ci NOT NULL,
  `status` enum('new','read','replied') COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'new',
  `replied_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `custom_bundle_types`
--

CREATE TABLE `custom_bundle_types` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `base_price` decimal(10,2) NOT NULL,
  `hero_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `card_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `features` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ;

--
-- Dumping data for table `custom_bundle_types`
--

INSERT INTO `custom_bundle_types` (`id`, `name`, `slug`, `title`, `description`, `base_price`, `hero_image`, `card_image`, `features`, `created_at`, `updated_at`) VALUES
(1, 'domestic', 'domestic', 'VACATION BUNDLE', 'Discover the beauty and excitement of Austin, TX. This destination offers amazing experiences, beautiful scenery, and unforgettable moments for all travelers.', 850.00, NULL, NULL, '[\"5 Days \\/ 4 Nights\",\"Deluxe Hotel Room\",\"Airport Transfers\",\"City Tour\"]', '2025-04-28 09:07:34', '2025-04-28 09:07:34');

-- --------------------------------------------------------

--
-- Table structure for table `custom_destinations`
--

CREATE TABLE `custom_destinations` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `location` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gallery` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ;

--
-- Dumping data for table `custom_destinations`
--

INSERT INTO `custom_destinations` (`id`, `name`, `slug`, `location`, `description`, `type`, `image`, `gallery`, `active`, `created_at`, `updated_at`) VALUES
(1, 'Atlanta, GA', 'atlanta-ga', 'atlanta', NULL, 'domestic', 'https://images.unsplash.com/photo-1575917649705-5b59aaa12e6b?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D', '[\"https:\\/\\/images.unsplash.com\\/photo-1605130284535-11dd9eedc58a?q=80&w=1993&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D,\",\"https:\\/\\/images.unsplash.com\\/photo-1548120037-cae500ca31b1?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D,\",\"https:\\/\\/images.unsplash.com\\/photo-1708098995597-a1251210df53?q=80&w=1932&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D\"]', 1, '2025-04-28 08:58:52', '2025-04-28 09:00:54'),
(2, 'Cancun, Mexico', 'cancun-mexico', 'cancun', NULL, 'international', 'https://images.unsplash.com/photo-1510097467424-192d713fd8b2?q=80&w=2000&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D', '[\"https:\\/\\/images.unsplash.com\\/photo-1596137628056-53f6817dab66?q=80&w=1974&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D ,\",\"https:\\/\\/images.unsplash.com\\/photo-1512152272829-e3139592d56f?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D ,\",\"https:\\/\\/images.unsplash.com\\/photo-1612454882173-3d6c04b82131?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D\"]', 1, '2025-04-28 09:01:55', '2025-04-28 09:01:55');

-- --------------------------------------------------------

--
-- Table structure for table `deal_of_weeks`
--

CREATE TABLE `deal_of_weeks` (
  `id` bigint UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `subtitle` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `features` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `price` decimal(10,2) NOT NULL DEFAULT '0.00',
  `discount_price` decimal(10,2) DEFAULT NULL,
  `expires_at` datetime DEFAULT NULL,
  `cta_text` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'BOOK NOW',
  `cta_link` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('active','inactive') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ;

--
-- Dumping data for table `deal_of_weeks`
--

INSERT INTO `deal_of_weeks` (`id`, `title`, `subtitle`, `description`, `features`, `image`, `price`, `discount_price`, `expires_at`, `cta_text`, `cta_link`, `status`, `created_at`, `updated_at`) VALUES
(5, 'Bundle Deal of the Week', 'Exciting Live Show Bundle', 'Exciting Live Show Bundle', '[\"One 5 Day, 4 Night Trip to Las Vegas, NV\",\"One 5 Day, 4 Night Trip to Branson, MO\",\"One 8 Day, 7 Night BONUS Monster Week trip\",\"WHITE GLOVE SERVICE\"]', 'deals/ohsle1DqVtTU1nusdSpqtdoZId6Gz0X60SjqGBV4.jpg', 498.00, NULL, '2025-09-07 23:59:59', 'BOOK NOW', '/bundles', 'active', '2025-05-30 11:56:55', '2025-05-30 11:57:22');

-- --------------------------------------------------------

--
-- Table structure for table `destinations`
--

CREATE TABLE `destinations` (
  `id` bigint UNSIGNED NOT NULL,
  `bundle_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `location` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `main_image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `included_items` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `restrictions` text COLLATE utf8mb4_unicode_ci,
  `gallery` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `destination_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'domestic',
  `display_in_custom_bundles` tinyint(1) NOT NULL DEFAULT '0'
) ;

--
-- Dumping data for table `destinations`
--

INSERT INTO `destinations` (`id`, `bundle_id`, `name`, `location`, `description`, `main_image`, `included_items`, `restrictions`, `gallery`, `created_at`, `updated_at`, `destination_type`, `display_in_custom_bundles`) VALUES
(1, 1, 'Punta Cana', 'Dominican Republic', 'Discover the tropical paradise of Punta Cana, known for its 20 miles of stunning white sand beaches and crystal-clear turquoise waters. Enjoy world-class all-inclusive resorts, championship golf courses, water activities, and vibrant nightlife in this Caribbean gem.', 'https://images.unsplash.com/photo-1546708973-b339540b5162?q=80&w=1974&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D', '\"[\\\"One 5 Day, 4 Night Trip to Punta Cana, DR\\\",\\\"Deluxe Standard Hotel Room\\\",\\\"Roundtrip Airport Transfers Included\\\",\\\"All Taxes, Fees & Resort Charges Included\\\",\\\"No Blackout Dates, Valid For 18 Months\\\"]\"', 'Some blackout dates may apply during peak season. Reservations are subject to availability.', '\"[\\\"https:\\\\\\/\\\\\\/images.unsplash.com\\\\\\/photo-1504897264915-7a1d030ccd00?q=80&w=1933&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D\\\",\\\"https:\\\\\\/\\\\\\/images.unsplash.com\\\\\\/photo-1620745897184-5a41fa400d2b?q=80&w=1932&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D\\\",\\\"https:\\\\\\/\\\\\\/images.unsplash.com\\\\\\/photo-1692017827893-f97d95397b49?q=80&w=1920&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D\\\",\\\"https:\\\\\\/\\\\\\/images.unsplash.com\\\\\\/photo-1551918120-9739cb430c6d?q=80&w=2887&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D\\\"]\"', '2025-04-29 10:25:27', '2025-05-02 16:17:31', 'domestic', 1),
(2, 1, 'Myrtle Beach', 'South Carolina', 'Experience the classic American beach vacation in Myrtle Beach, South Carolina. Enjoy 60 miles of beautiful beaches, the famous boardwalk, world-class golf courses, exciting entertainment options, delicious seafood restaurants, and family-friendly attractions along the Grand Strand.', 'https://images.unsplash.com/photo-1721927404458-fa1733a20e8f?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D', '[\"One 4 Day, 3 Night Trip to Myrtle Beach, SC\",\"2 Bedroom Unit on the Beach\",\"Oceanfront Property\",\"All Taxes, Fees & Resort Charges Included\",\"No Blackout Dates, Valid For 18 Months\"]', 'Some blackout dates may apply during peak season. Reservations are subject to availability.', '[\"https:\\/\\/images.unsplash.com\\/photo-1523457468663-00fe17545879?q=80&w=2071&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D\",\"https:\\/\\/images.unsplash.com\\/photo-1697688494916-6152ba0d4919?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D\",\"https:\\/\\/images.unsplash.com\\/photo-1533105079780-92b9be482077?q=80&w=2034&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D\",\"https:\\/\\/images.unsplash.com\\/photo-1629855979769-1726e4f6cd3c?q=80&w=1977&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D\"]', '2025-04-29 10:25:27', '2025-04-29 10:26:24', 'domestic', 1),
(3, 2, 'Las Vegas', 'Nevada', 'Experience the entertainment capital of the world with its dazzling lights, world-class shows, and vibrant nightlife. From spectacular productions to intimate performances, Las Vegas offers an unmatched variety of entertainment options for every taste.', 'https://images.unsplash.com/photo-1536942367753-3bdb71b7bb1c?q=80&w=1974&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D', '[\"One 3 Day, 2 Night Trip to Las Vegas, NV\",\"Deluxe Standard Hotel Room on the Strip\",\"One Free Show Ticket (Select Shows)\",\"All Taxes, Fees & Resort Charges Included\",\"No Blackout Dates, Valid For 18 Months\"]', 'Show selection subject to availability. Some blackout dates may apply during special events.', '[\"https:\\/\\/images.unsplash.com\\/photo-1629836076640-13e32aa0f293?q=80&w=1930&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D\",\"https:\\/\\/images.unsplash.com\\/photo-1605833556294-ea5c7a74f57d?q=80&w=2074&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D\",\"https:\\/\\/images.unsplash.com\\/photo-1605902711622-cfb43c4437b5?q=80&w=2069&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D\",\"https:\\/\\/images.unsplash.com\\/photo-1469854523086-cc02fe5d8800?q=80&w=2021&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D\"]', '2025-04-29 10:25:27', '2025-04-29 10:26:24', 'international', 1),
(4, 2, 'Branson', 'Missouri', 'Known as the \'Live Entertainment Capital of the Midwest,\' Branson offers over 100 shows featuring music, comedy, magic, and more. Set against the beautiful backdrop of the Ozark Mountains, this family-friendly destination combines entertainment with natural beauty.', 'https://images.unsplash.com/photo-1560651471-d7fca5abfd5f?q=80&w=1974&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D', '[\"One 3 Day, 2 Night Trip to Branson, MO\",\"2 Bedroom Unit in the Ozarks\",\"One Free Show During MyTravel Week Trip\",\"All Taxes, Fees & Resort Charges Included\",\"No Blackout Dates, Valid For 18 Months\"]', 'Show selection subject to availability. Some blackout dates may apply during special events.', '[\"https:\\/\\/images.unsplash.com\\/photo-1560651471-d7fca5abfd5f?q=80&w=1974&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D\",\"https:\\/\\/images.unsplash.com\\/photo-1514893011-72dfa15bd29c?q=80&w=1934&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D\",\"https:\\/\\/images.unsplash.com\\/photo-1568750530223-25bbef09600c?q=80&w=1974&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D\",\"https:\\/\\/images.unsplash.com\\/photo-1561393930-8c83ca7d2060?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D\"]', '2025-04-29 10:25:27', '2025-04-29 10:26:24', 'international', 1),
(5, 3, 'Cancun', 'Mexico', 'Discover the perfect blend of stunning beaches, ancient Mayan ruins, and vibrant nightlife in Cancun. Located on the Caribbean Sea, this Mexican paradise offers crystal-clear turquoise waters, white sand beaches, and world-class all-inclusive resorts for an unforgettable tropical getaway.', 'https://images.unsplash.com/photo-1510097467424-192d713fd8b2?q=80&w=2000&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D', '[\"One 5 Day, 4 Night Trip to Cancun, Mexico\",\"All-Inclusive Resort Accommodations\",\"Roundtrip Airport Transfers Included\",\"All Taxes, Fees & Resort Charges Included\",\"No Blackout Dates, Valid For 18 Months\"]', 'Valid passport required. Some blackout dates may apply during peak season. Reservations are subject to availability.', '[\"https:\\/\\/images.unsplash.com\\/photo-1510097467424-192d713fd8b2?q=80&w=2000&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D\",\"https:\\/\\/images.unsplash.com\\/photo-1552074283-095fd4e8dfc1?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D\",\"https:\\/\\/images.unsplash.com\\/photo-1545591853-dd70186241e9?q=80&w=2069&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D\",\"https:\\/\\/images.unsplash.com\\/photo-1620095198790-2f663d67677d?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D\"]', '2025-04-29 10:25:27', '2025-04-29 10:26:24', 'international', 1),
(6, 3, 'Punta Cana', 'Dominican Republic', 'Escape to the tropical paradise of Punta Cana, known for its 20 miles of stunning white sand beaches and crystal-clear turquoise waters. This Caribbean gem offers world-class all-inclusive resorts, championship golf courses, water activities, and vibrant nightlife.', 'https://images.unsplash.com/photo-1570737543098-0983d88f796d?q=80&w=1972&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D', '[\"One 5 Day, 4 Night Trip to Punta Cana, DR\",\"All-Inclusive Resort Accommodations\",\"Roundtrip Airport Transfers Included\",\"All Taxes, Fees & Resort Charges Included\",\"No Blackout Dates, Valid For 18 Months\"]', 'Valid passport required. Some blackout dates may apply during peak season. Reservations are subject to availability.', '[\"https:\\/\\/images.unsplash.com\\/photo-1569700946659-fe1941c71fe4?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D\",\"https:\\/\\/images.unsplash.com\\/photo-1504897264915-7a1d030ccd00?q=80&w=1933&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D\",\"https:\\/\\/images.unsplash.com\\/photo-1542397284385-6010376c5337?q=80&w=1974&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D\",\"https:\\/\\/images.unsplash.com\\/photo-1551918120-9739cb430c6d?q=80&w=2887&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D\"]', '2025-04-29 10:25:27', '2025-04-29 10:26:24', 'domestic', 1),
(7, 4, 'Aspen', 'Colorado, USA', 'Nestled in the Rocky Mountains, Aspen is a premier destination for outdoor enthusiasts. Enjoy world-class skiing, hiking trails, and charming alpine villages with vibrant dining and cultural scenes.', 'https://images.unsplash.com/photo-1600585154340-be6161a56a0c?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3', '[\"One 5 Day, 4 Night Trip to Aspen, CO\",\"Deluxe Cabin Accommodation\",\"Ski Lift Passes Included\",\"All Taxes, Fees & Resort Charges Included\",\"No Blackout Dates, Valid For 18 Months\"]', 'Some blackout dates may apply during peak winter season. Reservations are subject to availability.', '[\"https:\\/\\/images.unsplash.com\\/photo-1600585154340-be6161a56a0c?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3\",\"https:\\/\\/images.unsplash.com\\/photo-1519681393784-d120267933ba?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3\",\"https:\\/\\/images.unsplash.com\\/photo-1496516409069-f135ee19b2eb?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D\",\"https:\\/\\/images.unsplash.com\\/photo-1506905925346-21bda4d32df4?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3\"]', '2025-04-29 10:25:27', '2025-04-29 10:26:24', 'international', 1),
(8, 4, 'Banff', 'Alberta, Canada', 'Banff offers stunning mountain landscapes in the heart of the Canadian Rockies. Explore turquoise lakes, majestic peaks, and abundant wildlife, with activities like hiking, skiing, and hot spring relaxation.', 'https://images.unsplash.com/photo-1464822759023-fed622ff2c3b?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3', '[\"One 5 Day, 4 Night Trip to Banff, Canada\",\"Lodge Accommodation with Mountain Views\",\"National Park Pass Included\",\"All Taxes, Fees & Resort Charges Included\",\"No Blackout Dates, Valid For 18 Months\"]', 'Valid passport required. Some blackout dates may apply during peak season. Reservations are subject to availability.', '[\"https:\\/\\/images.unsplash.com\\/photo-1464822759023-fed622ff2c3b?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3\",\"https:\\/\\/images.unsplash.com\\/photo-1710300921395-35ee7b6e5fbe?q=80&w=1974&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D\",\"https:\\/\\/images.unsplash.com\\/photo-1507525428034-b723cf961d3e?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3\",\"https:\\/\\/images.unsplash.com\\/photo-1602702878368-470c85f426a1?q=80&w=2142&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D\"]', '2025-04-29 10:25:27', '2025-04-29 10:26:24', 'international', 1),
(9, 5, 'Rome', 'Italy', 'Step into history in Rome, where ancient ruins like the Colosseum and Roman Forum meet vibrant piazzas and world-class cuisine. Explore the Eternal City’s art, culture, and history with expert-guided tours.', 'https://images.unsplash.com/photo-1498307833015-e7b400441eb8?q=80&w=2128&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D', '[\"One 5 Day, 4 Night Trip to Rome, Italy\",\"Boutique Hotel in Historic Center\",\"Guided Colosseum and Vatican Tours\",\"All Taxes, Fees & Charges Included\",\"No Blackout Dates, Valid For 18 Months\"]', 'Valid passport required. Some blackout dates may apply during peak season. Reservations are subject to availability.', '[\"https:\\/\\/images.unsplash.com\\/photo-1498307833015-e7b400441eb8?q=80&w=2128&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D\",\"https:\\/\\/images.unsplash.com\\/photo-1664485032641-127031773396?q=80&w=1932&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D\",\"https:\\/\\/images.unsplash.com\\/photo-1519915028121-7d3463d20b13?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3\",\"https:\\/\\/images.unsplash.com\\/photo-1520175480921-4edfa2983e0f?q=80&w=2067&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D\"]', '2025-04-29 10:25:27', '2025-04-29 10:26:24', 'domestic', 1),
(10, 5, 'Kyoto', 'Japan', 'Kyoto, Japan’s cultural heart, offers serene temples, traditional tea houses, and stunning gardens. Immerse yourself in centuries-old traditions, from geisha districts to Zen meditation experiences.', 'https://images.unsplash.com/photo-1610265082060-7234c9de51ab?q=80&w=2071&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D', '[\"One 5 Day, 4 Night Trip to Kyoto, Japan\",\"Traditional Ryokan Stay\",\"Guided Temple and Garden Tours\",\"All Taxes, Fees & Charges Included\",\"No Blackout Dates, Valid For 18 Months\"]', 'Valid passport required. Some blackout dates may apply during cherry blossom season. Reservations are subject to availability.', '[\"https:\\/\\/images.unsplash.com\\/photo-1707474893587-a37a9cf1b555?q=80&w=1974&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D\",\"https:\\/\\/images.unsplash.com\\/photo-1588000316012-ae41e1c9db1a?q=80&w=1932&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D\",\"https:\\/\\/images.unsplash.com\\/photo-1664218018556-0bf1297c7653?q=80&w=1932&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D\",\"https:\\/\\/images.unsplash.com\\/photo-1493976040374-85c8e12f0c0e?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3\"]', '2025-04-29 10:25:27', '2025-04-29 10:26:24', 'international', 1),
(11, 6, 'Maasai Mara', 'Kenya', 'The Maasai Mara is world-renowned for its vast savannas and the Great Migration of wildebeest. Spot the Big Five on guided game drives and immerse yourself in Maasai culture.', 'https://images.unsplash.com/photo-1516426122078-c23e76319801?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3', '[\"One 5 Day, 4 Night Trip to Maasai Mara, Kenya\",\"Luxury Safari Lodge Accommodation\",\"Daily Guided Game Drives\",\"All Taxes, Fees & Charges Included\",\"No Blackout Dates, Valid For 18 Months\"]', 'Valid passport required. Some blackout dates may apply during peak migration season. Reservations are subject to availability.', '[\"https:\\/\\/images.unsplash.com\\/photo-1516426122078-c23e76319801?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3\",\"https:\\/\\/images.unsplash.com\\/photo-1602410125631-7e736e36797c?q=80&w=1933&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D\",\"https:\\/\\/images.unsplash.com\\/photo-1547471080-7cc2caa01a7e?q=80&w=2071&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D\",\"https:\\/\\/images.unsplash.com\\/photo-1602410141957-ee70b4739066?q=80&w=1974&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D\"]', '2025-04-29 10:25:27', '2025-05-30 14:07:10', 'international', 1),
(12, 6, 'Kruger National Park', 'South Africa', 'Kruger National Park is one of Africa’s largest game reserves, home to an abundance of wildlife including the Big Five. Enjoy luxury lodges and thrilling safari experiences in this iconic destination.', 'https://images.unsplash.com/photo-1504173010664-32509aeebb62?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3', '[\"One 5 Day, 4 Night Trip to Kruger National Park, South Africa\",\"Luxury Safari Lodge Accommodation\",\"Daily Guided Game Drives\",\"All Taxes, Fees & Charges Included\",\"No Blackout Dates, Valid For 18 Months\"]', 'Valid passport required. Some blackout dates may apply during peak season. Reservations are subject to availability.', '[\"https:\\/\\/images.unsplash.com\\/photo-1504173010664-32509aeebb62?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3\",\"https:\\/\\/images.unsplash.com\\/photo-1602410132231-9e6c692e02db?q=80&w=1974&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D\",\"https:\\/\\/images.unsplash.com\\/photo-1602410141957-ee70b4739066?q=80&w=1974&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D\",\"https:\\/\\/images.unsplash.com\\/photo-1602410125631-7e736e36797c?q=80&w=1933&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D\"]', '2025-04-29 10:25:27', '2025-04-29 10:26:24', 'international', 1),
(13, 7, 'Bora Bora', 'French Polynesia', 'Bora Bora is a bucket-list destination with its iconic turquoise lagoon, lush volcanic peaks, and luxurious overwater bungalows. Enjoy snorkeling, jet skiing, and romantic sunsets in this South Pacific paradise.', 'https://images.unsplash.com/photo-1589806036187-fcbc6a7a23b6?q=80&w=1992&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D', '[\"One 5 Day, 4 Night Trip to Bora Bora, French Polynesia\",\"Overwater Bungalow Accommodation\",\"Daily Breakfast and Snorkeling Tour\",\"All Taxes, Fees & Resort Charges Included\",\"No Blackout Dates, Valid For 18 Months\"]', 'Valid passport required. Some blackout dates may apply during peak season. Reservations are subject to availability.', '[\"https:\\/\\/images.unsplash.com\\/photo-1652842183703-47c2f7bb8c3c?q=80&w=1932&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D\",\"https:\\/\\/images.unsplash.com\\/photo-1509233725247-49e657c54213?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3\",\"https:\\/\\/images.unsplash.com\\/photo-1665904640593-e397a72dee9f?q=80&w=1931&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D\",\"https:\\/\\/images.unsplash.com\\/photo-1691113199489-0d53a2e6f2d6?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D\"]', '2025-04-29 10:25:27', '2025-04-29 10:26:24', 'international', 1),
(14, 7, 'Maldives', 'Indian Ocean', 'The Maldives is a tropical paradise with crystal-clear waters, vibrant coral reefs, and private island resorts. Relax on white sand beaches, dive with marine life, and enjoy unparalleled luxury in this island nation.', 'https://images.unsplash.com/photo-1573843981267-be1999ff37cd?q=80&w=1974&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D', '[\"One 5 Day, 4 Night Trip to the Maldives\",\"Water Villa Accommodation\",\"Roundtrip Seaplane Transfers\",\"All Taxes, Fees & Resort Charges Included\",\"No Blackout Dates, Valid For 18 Months\"]', 'Valid passport required. Some blackout dates may apply during peak season. Reservations are subject to availability.', '[\"https:\\/\\/images.unsplash.com\\/photo-1590523277543-a94d2e4eb00b?q=80&w=1932&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D\",\"https:\\/\\/images.unsplash.com\\/photo-1509233725247-49e657c54213?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3\",\"https:\\/\\/images.unsplash.com\\/photo-1576158831003-d41033ec31fd?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D\",\"https:\\/\\/images.unsplash.com\\/photo-1489252614717-e24ec918e368?q=80&w=1932&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D\"]', '2025-04-29 10:25:27', '2025-04-29 10:26:24', 'domestic', 1),
(15, 8, 'New York City', 'New York, USA', 'New York City is the city that never sleeps, offering iconic landmarks like Times Square, Central Park, and the Statue of Liberty. Enjoy Broadway shows, diverse cuisine, and endless cultural experiences.', 'https://images.unsplash.com/photo-1496442226666-8d4d0e62e6e9?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3', '[\"One 4 Day, 3 Night Trip to New York City, NY\",\"Deluxe Hotel in Manhattan\",\"Guided City Highlights Tour\",\"All Taxes, Fees & Charges Included\",\"No Blackout Dates, Valid For 18 Months\"]', 'Some blackout dates may apply during major holidays. Reservations are subject to availability.', '[\"https:\\/\\/images.unsplash.com\\/photo-1496442226666-8d4d0e62e6e9?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3\",\"https:\\/\\/images.unsplash.com\\/photo-1500916434205-0c77489c6cf7?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3\",\"https:\\/\\/images.unsplash.com\\/photo-1568515387631-8b650bbcdb90?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D\",\"https:\\/\\/images.unsplash.com\\/photo-1518391846015-55a9cc003b25?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3\"]', '2025-04-29 10:25:27', '2025-04-29 10:26:24', 'domestic', 1),
(16, 8, 'Tokyo', 'Japan', 'Tokyo blends tradition and innovation with ancient temples, bustling Shibuya Crossing, and cutting-edge technology. Explore vibrant neighborhoods, savor sushi, and experience Japan’s unique culture.', 'https://images.unsplash.com/photo-1507608869274-d3177c8bb4c7?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3', '[\"One 4 Day, 3 Night Trip to Tokyo, Japan\",\"Central Tokyo Hotel Accommodation\",\"Guided Cultural City Tour\",\"All Taxes, Fees & Charges Included\",\"No Blackout Dates, Valid For 18 Months\"]', 'Valid passport required. Some blackout dates may apply during peak seasons. Reservations are subject to availability.', '[\"https:\\/\\/images.unsplash.com\\/photo-1507608869274-d3177c8bb4c7?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3\",\"https:\\/\\/images.unsplash.com\\/photo-1518391846015-55a9cc003b25?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3\",\"https:\\/\\/images.unsplash.com\\/photo-1540959733332-eab4deabeeaf?q=80&w=2094&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D\",\"https:\\/\\/images.unsplash.com\\/photo-1500916434205-0c77489c6cf7?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3\"]', '2025-04-29 10:25:27', '2025-04-29 10:26:24', 'domestic', 1),
(17, 9, 'Tuscany', 'Italy', 'Tuscany’s rolling hills are home to world-class vineyards and historic estates. Savor Chianti and Brunello wines, explore medieval villages, and enjoy farm-to-table cuisine in this picturesque region.', 'https://images.unsplash.com/photo-1651309259727-99b5f13f3a1a?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D', '[\"One 5 Day, 4 Night Trip to Tuscany, Italy\",\"Charming Vineyard Villa Stay\",\"Three Guided Wine Tasting Tours\",\"All Taxes, Fees & Charges Included\",\"No Blackout Dates, Valid For 18 Months\"]', 'Valid passport required. Some blackout dates may apply during harvest season. Reservations are subject to availability.', '[\"https:\\/\\/images.unsplash.com\\/photo-1684836571999-f3dc511935e7?q=80&w=1974&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D\",\"https:\\/\\/images.unsplash.com\\/photo-1671365204667-f524b387929c?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D\",\"https:\\/\\/images.unsplash.com\\/photo-1522771739844-6a9f6d5f14af?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3\",\"https:\\/\\/images.unsplash.com\\/photo-1632660967293-ec569f27dfd0?q=80&w=1956&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D\"]', '2025-04-29 10:25:27', '2025-04-29 10:26:24', 'domestic', 1),
(18, 9, 'Napa Valley', 'California, USA', 'Napa Valley is America’s premier wine region, known for its Cabernet Sauvignon and stunning vineyard landscapes. Enjoy exclusive wine tastings, gourmet dining, and hot air balloon rides over the valley.', 'https://images.unsplash.com/photo-1734970003644-3ddaed21702e?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D', '[\"One 5 Day, 4 Night Trip to Napa Valley, CA\",\"Boutique Hotel in Wine Country\",\"Three Guided Wine Tasting Tours\",\"All Taxes, Fees & Charges Included\",\"No Blackout Dates, Valid For 18 Months\"]', 'Some blackout dates may apply during harvest season. Reservations are subject to availability.', '[\"https:\\/\\/images.unsplash.com\\/photo-1589470028798-c0acf0b7f236?q=80&w=2120&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D\",\"https:\\/\\/images.unsplash.com\\/photo-1728932558696-e9cbcc533dca?q=80&w=2064&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D\",\"https:\\/\\/images.unsplash.com\\/photo-1522771739844-6a9f6d5f14af?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3\",\"https:\\/\\/images.unsplash.com\\/photo-1697070920803-5cc4ea492c7d?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D\"]', '2025-04-29 10:25:27', '2025-04-29 10:26:24', 'domestic', 1);

-- --------------------------------------------------------

--
-- Table structure for table `email_settings`
--

CREATE TABLE `email_settings` (
  `id` bigint UNSIGNED NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `welcome_message` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `account_details` text COLLATE utf8mb4_unicode_ci,
  `closing_message` text COLLATE utf8mb4_unicode_ci,
  `button_text` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `signature` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `company_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `additional_footer` text COLLATE utf8mb4_unicode_ci,
  `header_bg_color` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `header_text_color` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `primary_color` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `button_bg_color` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `button_text_color` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `button_hover_color` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `footer_bg_color` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `footer_text_color` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `footer_link_color` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `email_settings`
--

INSERT INTO `email_settings` (`id`, `type`, `email_title`, `welcome_message`, `account_details`, `closing_message`, `button_text`, `signature`, `company_name`, `additional_footer`, `header_bg_color`, `header_text_color`, `primary_color`, `button_bg_color`, `button_text_color`, `button_hover_color`, `footer_bg_color`, `footer_text_color`, `footer_link_color`, `created_at`, `updated_at`) VALUES
(1, 'registration', 'Welcome to MyTravel!', 'Thank you for creating an account with MyTravel! We\'re excited to have you join our community of travelers and explorers. Your account has been successfully created and you can now access all the features of our platform.', 'Your account details:', 'If you have any questions or need assistance, please don\'t hesitate to contact our support team. We\'re here to help make your travel experience exceptional!', 'Login to Your Account', 'Best regards,', 'The MyTravel Team', '', '#1a56db', '#ffffff', '#1a56db', '#1a56db', '#ffffff', '#1e40af', '#1f2937', '#ffffff', '#ffffff', '2025-05-01 21:59:04', '2025-05-01 21:59:04');

-- --------------------------------------------------------

--
-- Table structure for table `email_subscriptions`
--

CREATE TABLE `email_subscriptions` (
  `id` bigint UNSIGNED NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `status` enum('active','unsubscribed') COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'active',
  `subscribed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `unsubscribed_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `email_verifications`
--

CREATE TABLE `email_verifications` (
  `id` int UNSIGNED NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `email_verifications`
--

INSERT INTO `email_verifications` (`id`, `email`, `token`, `created_at`) VALUES
(16, 'mdpanna600@gmail.com', '804972', '2025-05-30 12:47:10'),
(17, 'mdpanna800@gmail.com', '319085', '2025-05-21 21:53:48'),
(18, 'mdpanna600@gmail.com', '642636', '2025-05-21 22:07:18'),
(20, 'mdpanna600@gmail.com', '530940', '2025-05-30 12:46:56');

-- --------------------------------------------------------

--
-- Table structure for table `faqs`
--

CREATE TABLE `faqs` (
  `id` bigint UNSIGNED NOT NULL,
  `category` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `question` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `answer` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `order` int NOT NULL DEFAULT '0',
  `status` enum('active','inactive') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `faqs`
--

INSERT INTO `faqs` (`id`, `category`, `question`, `answer`, `order`, `status`, `created_at`, `updated_at`) VALUES
(1, 'General', 'What is your service about?', 'Our service provides comprehensive solutions for your needs, offering high-quality support and resources.', 2, 'active', '2025-04-29 10:28:54', '2025-05-26 12:09:39'),
(2, 'General', 'How can I contact support?', 'You can reach our support team via email at support@example.com or through our contact form.', 5, 'active', '2025-04-29 10:28:54', '2025-05-26 12:09:39'),
(3, 'Billing', 'What payment methods do you accept?', 'We accept major credit cards, PayPal, and bank transfers.', 3, 'active', '2025-04-29 10:28:54', '2025-05-26 12:09:39'),
(4, 'Billing', 'Can I get a refund?', 'Yes, we offer a 30-day money-back guarantee. Please contact support for assistance.', 6, 'active', '2025-04-29 10:28:54', '2025-05-26 12:09:39'),
(5, 'Technical', 'How do I reset my password?', 'Click the \"Forgot Password\" link on the login page and follow the instructions.', 4, 'active', '2025-04-29 10:28:54', '2025-05-26 12:09:39');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(15, '2025_05_01_000001_create_custom_bundle_tables', 4),
(19, '2025_04_29_155924_create_settings_table', 7),
(20, '2014_10_12_000000_create_users_table', 8),
(21, '2025_04_26_045325_create_blog_categories_table', 8),
(22, '2025_04_26_045326_create_tags_table', 8),
(23, '2025_04_26_045327_create_blogs_table', 8),
(24, '2025_04_26_045328_create_blog_tag_table', 8),
(25, '2025_04_26_045331_create_bundles_table', 8),
(26, '2025_04_26_045331_create_comments_table', 8),
(27, '2025_04_26_045331_create_destinations_table', 8),
(28, '2025_04_26_045332_create_bundle_extras_table', 8),
(29, '2025_04_26_045332_create_user_bookings_table', 8),
(30, '2025_04_26_175006_create_faq_table', 8),
(31, '2025_04_26_175006_create_testimonial_table', 8),
(32, '2025_04_27_154439_add_status_to_bundles_table', 8),
(33, '2025_04_27_154646_add_number_of_people_to_user_bookings_table', 8),
(34, '2025_04_28_000002_create_bundle_types_table', 8),
(35, '2025_04_28_000002_setting_table', 8),
(36, '2025_04_28_000002_TravelPackages', 9),
(37, '2025_04_30_create_deal_of_weeks_table', 10),
(38, '2025_04_30_065346_create_contact_settings_table', 11),
(39, '2025_05_02_create_CreateEmailSettingsTable', 12);

-- --------------------------------------------------------

--
-- Table structure for table `navigation_items`
--

CREATE TABLE `navigation_items` (
  `id` bigint UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `url` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `parent_id` bigint UNSIGNED DEFAULT NULL,
  `position` int DEFAULT '0',
  `is_active` tinyint(1) DEFAULT '1',
  `target` varchar(255) COLLATE utf8mb4_general_ci DEFAULT '_self',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `navigation_items`
--

INSERT INTO `navigation_items` (`id`, `title`, `url`, `parent_id`, `position`, `is_active`, `target`, `created_at`, `updated_at`) VALUES
(1, 'HOME', '/', NULL, 0, 0, '_self', '2025-05-03 05:10:14', '2025-06-17 01:37:41'),
(2, 'VACATION BUNDLES', '#', NULL, 1, 0, '_self', '2025-05-03 05:10:14', '2025-06-17 01:36:36'),
(3, 'VACATION BUNDLES', '/bundles', 2, 0, 1, '_self', '2025-05-03 05:10:14', '2025-05-03 05:10:14'),
(4, 'BUNDLE OF THE WEEK', '/#deal-week', 2, 1, 1, '_self', '2025-05-03 05:10:14', '2025-05-30 12:24:55'),
(5, 'CUSTOM BUNDLES', '/custom-bundles', 2, 2, 1, '_self', '2025-05-03 05:10:14', '2025-05-03 05:10:14'),
(6, 'MEMBERSHIP', '/tiers', NULL, 1, 1, '_self', '2025-05-03 05:10:14', '2025-06-17 01:37:28'),
(7, 'FAQS', '/faq', NULL, 3, 1, '_self', '2025-05-03 05:10:14', '2025-05-02 23:30:26'),
(9, 'BLOG', '/blog', NULL, 4, 1, '_self', '2025-05-02 23:19:03', '2025-05-02 23:31:00');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `password_resets`
--

INSERT INTO `password_resets` (`email`, `token`, `created_at`) VALUES
('mdpannasunny@gmail.com', '071480', '2025-05-02 23:55:04');

-- --------------------------------------------------------

--
-- Table structure for table `payment_gateways`
--

CREATE TABLE `payment_gateways` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gateway_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '0',
  `is_default` tinyint(1) NOT NULL DEFAULT '0',
  `description` text COLLATE utf8mb4_unicode_ci,
  `instructions` text COLLATE utf8mb4_unicode_ci,
  `config` longtext COLLATE utf8mb4_unicode_ci,
  `icon` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `payment_gateways`
--

INSERT INTO `payment_gateways` (`id`, `name`, `display_name`, `gateway_type`, `is_active`, `is_default`, `description`, `instructions`, `config`, `icon`, `created_at`, `updated_at`) VALUES
(2, 'Stripe', 'Tryp Bug', 'stripe', 1, 0, 'Pay With Credit/Debit', NULL, '{\"secret_key\":\"CraftBeer@1\"}', 'payment-gateways/6rT5268XLKxqfZ9BAMkf0l1kRn2BrYwHF6qvJOn3.png', '2025-06-11 03:42:07', '2025-06-11 03:42:07');

-- --------------------------------------------------------

--
-- Table structure for table `privacies`
--

CREATE TABLE `privacies` (
  `id` bigint UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `content` longtext COLLATE utf8mb4_general_ci NOT NULL,
  `status` enum('active','inactive') COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'active',
  `is_default` tinyint(1) NOT NULL DEFAULT '0',
  `meta_title` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `meta_description` text COLLATE utf8mb4_general_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `privacies`
--

INSERT INTO `privacies` (`id`, `title`, `content`, `status`, `is_default`, `meta_title`, `meta_description`, `created_at`, `updated_at`) VALUES
(1, 'Privacy Policy', '<p>MyTravel Reservations Group (\"us\", \"we\", or \"our\") operates mytravel.com (the \"Site\"). This page informs you of our policies regarding the collection, use and disclosure of Personal Information we receive from users of the Site.</p><p>We use your Personal Information only for providing and improving the Site. By using the Site, you agree to the collection and use of information in accordance with this policy.</p><h3><strong>INFORMATION COLLECTION AND USE</strong></h3><p>While using our Site, we may ask you to provide us with certain personally identifiable information that can be used to contact or identify you. Personally identifiable information may include, but is not limited to your name (\"Personal Information\").</p><h3><strong>LOG DATA</strong></h3><p>Like many site operators, we collect information that your browser sends whenever you visit our Site (\"Log Data\").</p><p>This Log Data may include information such as your computer\'s Internet Protocol (\"IP\") address, browser type, browser version, the pages of our Site that you visit, the time and date of your visit, the time spent on those pages and other statistics.</p><p>In addition, we may use third party services such as Google Analytics that collect, monitor and analyze this.</p><h3><strong>COMMUNICATIONS</strong></h3><p>We may use your Personal Information to contact you with newsletters, marketing or promotional materials and other information.</p><h3><strong>SMS</strong></h3><p>Mobile opt-in data will not be shared with third parties.</p><h3><strong>COOKIES</strong></h3><p>Cookies are files with small amount of data, which may include an anonymous unique identifier. Cookies are sent to your browser from a web site and stored on your computer\'s hard drive.</p><p>Like many sites, we use \"cookies\" to collect information. You can instruct your browser to refuse all cookies or to indicate when a cookie is being sent. However, if you do not accept cookies, you may not be able to use some portions of our Site.</p><h3><strong>SECURITY</strong></h3><p>The security of your Personal Information is important to us, but remember that no method of transmission over the Internet, or method of electronic storage, is 100% secure. While we strive to use commercially acceptable means to protect your Personal Information, we cannot guarantee its absolute security.</p><h3><strong>CHANGES TO THIS PRIVACY POLICY</strong></h3><p>We reserve the right to update or change our Privacy Policy at any time and you should check this Privacy Policy periodically. Your continued use of the Service after we post any modifications to the Privacy Policy on this page will constitute your acknowledgment of the modifications and your consent to abide and be bound by the modified Privacy Policy.</p><p>If we make any material changes to this Privacy Policy, we will notify you either through the email address you have provided us, or by placing a prominent notice on our website.</p>', 'active', 1, 'Our Privacy Policy', 'Learn how we protect your personal data and privacy.', '2025-05-01 17:10:23', '2025-05-30 12:24:45');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` bigint UNSIGNED NOT NULL,
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` text COLLATE utf8mb4_unicode_ci,
  `group` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'general',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `key`, `value`, `group`, `created_at`, `updated_at`) VALUES
(1, 'site_logo', 'storage/logos/7Hx0NJN8GwxI1srCWrhfQQpt1hJx7CS4fu33xzhC.png', 'appearance', NULL, '2025-05-30 03:37:28'),
(2, 'site_logo_mobile', 'storage/logos/OclrFfvEuEAL70hVIGHzfj7S1Gr9BTzTnZZjMwLk.png', 'appearance', NULL, '2025-05-30 03:37:28'),
(3, 'header_bg_color_from', '#3e68bb', 'appearance', NULL, '2025-05-26 12:55:59'),
(4, 'header_bg_color_to', '#3e68bb', 'appearance', NULL, '2025-05-26 12:55:59'),
(5, 'footer_bg_color_from', '#5a82d3', 'appearance', NULL, '2025-05-26 12:55:59'),
(6, 'footer_bg_color_to', '#5a82d3', 'appearance', NULL, '2025-05-26 12:55:59'),
(7, 'company_name', 'Tryp Bug', 'general', NULL, '2025-06-11 03:31:31'),
(8, 'company_address', '7901 4th St N  St. Petersburg, FL  33702', 'contact', NULL, '2025-06-11 03:32:59'),
(9, 'company_phone', '1-800-918-9975', 'contact', NULL, '2025-06-11 03:32:59'),
(10, 'company_email', 'info@mytravel.com', 'contact', NULL, '2025-05-30 12:11:49'),
(11, 'office_hours', 'Everyday: 10AM-10PM EST', 'contact', NULL, '2025-06-11 03:32:59'),
(12, 'about_us_short', 'TrypBug has been helping travelers explore the world for over 15 years. We\'re committed to providing unforgettable experiences.', 'general', NULL, '2025-06-11 03:31:31'),
(13, 'hero_heading', 'Discover Your Perfect Getaway', 'appearance', '2025-05-02 03:15:00', '2025-05-26 11:41:31'),
(14, 'hero_subheading', 'Explore exclusive vacation packages and create memories that last a lifetime', 'appearance', '2025-05-02 03:15:00', '2025-05-26 11:41:31'),
(15, 'hero_bg_image', 'storage/hero/7uY5jJLbY1RSPtxRZ8xcxt9h16RsjEUdUHu0tTTV.jpg', 'appearance', '2025-05-02 03:15:00', '2025-05-30 12:10:54'),
(16, 'home_bundles_count', '6', 'display', NULL, '2025-05-30 12:13:45'),
(17, 'home_destinations_count', '6', 'display', NULL, '2025-05-30 12:13:45'),
(18, 'testimonials_count', '8', 'display', NULL, '2025-05-30 12:13:45'),
(19, 'primary_button_color', '#2263fc', 'appearance', '2025-05-25 03:16:15', '2025-05-26 12:55:59'),
(20, 'primary_button_hover_color', '#f8c621', 'appearance', '2025-05-25 03:16:15', '2025-05-27 05:42:22'),
(21, 'primary_gradient_from', '#2263fc', 'appearance', '2025-05-25 03:16:15', '2025-05-26 12:55:59'),
(22, 'primary_gradient_to', '#335fc7', 'appearance', '2025-05-25 03:16:15', '2025-05-26 12:55:59'),
(23, 'primary_gradient_hover_from', '#335fc7', 'appearance', '2025-05-25 03:16:15', '2025-05-26 12:55:59'),
(24, 'primary_gradient_hover_to', '#2263fc', 'appearance', '2025-05-25 03:16:15', '2025-05-26 12:55:59'),
(25, 'secondary_gradient_from', '#f8c621', 'appearance', '2025-05-25 03:16:15', '2025-05-26 12:55:59'),
(26, 'secondary_gradient_to', '#fac822', 'appearance', '2025-05-25 03:16:15', '2025-05-26 12:55:59'),
(27, 'secondary_gradient_hover_from', '#c49f23', 'appearance', '2025-05-25 03:16:15', '2025-05-26 12:55:59'),
(28, 'secondary_gradient_hover_to', '#c49f23', 'appearance', '2025-05-25 03:16:15', '2025-05-26 12:55:59'),
(39, 'icon_color_primary', '#5a82d3', 'appearance', NULL, '2025-05-26 12:55:59'),
(40, 'overlay_bg_color_from', '#808080', 'appearance', '2025-05-26 10:36:23', '2025-05-26 11:41:31'),
(41, 'overlay_bg_color_to', '#808080', 'appearance', '2025-05-26 10:36:23', '2025-05-26 11:41:31'),
(42, 'page_title_bg_color_from', '#d2c151', 'appearance', '2025-05-26 10:36:23', '2025-05-26 12:55:59'),
(43, 'page_title_bg_color_to', '#d2c151', 'appearance', '2025-05-26 10:36:23', '2025-05-26 12:55:59'),
(44, 'css_version', '1748607054', 'appearance', '2025-05-26 10:36:23', '2025-05-30 12:10:54');

-- --------------------------------------------------------

--
-- Table structure for table `subscribers`
--

CREATE TABLE `subscribers` (
  `id` bigint UNSIGNED NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `subscribed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `unsubscribed_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tags`
--

CREATE TABLE `tags` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tags`
--

INSERT INTO `tags` (`id`, `name`, `slug`, `created_at`, `updated_at`) VALUES
(1, 'Summer Vacation', 'summer-vacation', '2025-04-29 10:13:14', '2025-04-29 10:13:14'),
(2, 'Theme Parks', 'theme-parks', '2025-04-29 10:13:14', '2025-04-29 10:13:14'),
(3, 'Family Travel', 'family-travel', '2025-04-29 10:13:14', '2025-04-29 10:13:14'),
(4, 'Festivals', 'festivals', '2025-04-29 10:13:14', '2025-04-29 10:13:14'),
(5, 'Cultural Travel', 'cultural-travel', '2025-04-29 10:13:14', '2025-04-29 10:13:14'),
(6, 'City Breaks', 'city-breaks', '2025-04-29 10:13:14', '2025-04-29 10:13:14'),
(7, 'Romantic Travel', 'romantic-travel', '2025-04-29 10:13:14', '2025-04-29 10:13:14'),
(8, 'Luxury Travel', 'luxury-travel', '2025-04-29 10:13:14', '2025-04-29 10:13:14'),
(9, 'Couples Getaways', 'couples-getaways', '2025-04-29 10:13:14', '2025-04-29 10:13:14'),
(10, 'Beach Vacations', 'beach-vacations', '2025-04-29 10:13:14', '2025-04-29 10:13:14'),
(11, 'Mexico', 'mexico', '2025-04-29 10:13:14', '2025-04-29 10:13:14'),
(12, 'Travel Planning', 'travel-planning', '2025-04-29 10:13:14', '2025-04-29 10:13:14'),
(13, 'Caribbean', 'caribbean', '2025-04-29 10:13:14', '2025-04-29 10:13:14'),
(14, 'Off The Beaten Path', 'off-the-beaten-path', '2025-04-29 10:13:14', '2025-04-29 10:13:14'),
(15, 'Island Life', 'island-life', '2025-04-29 10:13:14', '2025-04-29 10:13:14'),
(16, 'Las Vegas', 'las-vegas', '2025-04-29 10:13:14', '2025-04-29 10:13:14'),
(17, 'Casino Guide', 'casino-guide', '2025-04-29 10:13:14', '2025-04-29 10:13:14'),
(18, 'Entertainment', 'entertainment', '2025-04-29 10:13:14', '2025-04-29 10:13:14'),
(19, 'Travel Technology', 'travel-technology', '2025-04-29 10:13:14', '2025-04-29 10:13:14');

-- --------------------------------------------------------

--
-- Table structure for table `testimonials`
--

CREATE TABLE `testimonials` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `rating` decimal(3,2) NOT NULL DEFAULT '5.00',
  `location` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('active','inactive') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `testimonials`
--

INSERT INTO `testimonials` (`id`, `name`, `image`, `description`, `rating`, `location`, `status`, `created_at`, `updated_at`) VALUES
(1, 'John Doe', '', 'This service has been a game-changer for my business! Highly recommended.', 4.80, 'New York, NY', 'active', '2025-04-29 10:29:32', '2025-04-29 10:29:32'),
(2, 'Jane Smith', '', 'Excellent support and fantastic features. My experience has been amazing!', 5.00, 'Los Angeles, CA', 'active', '2025-04-29 10:29:32', '2025-04-29 10:29:32'),
(3, 'Michael Brown', NULL, 'Reliable and easy to use. The team was very responsive to my queries.', 4.50, 'Chicago, IL', 'active', '2025-04-29 10:29:32', '2025-04-29 10:29:32'),
(4, 'Emily Davis', '', 'Great value for money. The platform is intuitive and powerful.', 1.00, 'Houston, TX', 'active', '2025-04-29 10:29:32', '2025-04-29 21:33:29'),
(5, 'David Wilson', NULL, 'I’ve been using this for months, and it’s consistently exceeded expectations.', 5.00, 'Miami, FL', 'active', '2025-04-29 10:29:32', '2025-04-29 10:29:32'),
(6, 'Sarah Johnson', NULL, 'The platform is user-friendly and the support team is top-notch!', 4.90, 'Seattle, WA', 'active', '2025-04-30 02:15:22', '2025-04-30 02:15:22'),
(7, 'Robert Martinez', '', 'A fantastic tool that has streamlined our operations significantly.', 4.70, 'Boston, MA', 'active', '2025-04-30 03:30:45', '2025-04-30 03:30:45'),
(8, 'Lisa Thompson', NULL, 'I love the features, but the onboarding could be smoother.', 4.20, 'Austin, TX', 'active', '2025-04-30 04:45:12', '2025-04-30 04:45:12'),
(9, 'James Lee', '', 'Absolutely worth the investment. It’s boosted our productivity.', 5.00, 'San Francisco, CA', 'active', '2025-04-30 06:00:33', '2025-04-30 06:00:33'),
(10, 'Amanda Clark', NULL, 'The service is great, though I wish there were more customization options.', 4.30, 'Denver, CO', 'active', '2025-04-30 08:20:19', '2025-04-30 08:20:19'),
(11, 'Thomas White', '', 'Reliable and efficient. It’s been a pleasure to use this platform.', 4.80, 'Portland, OR', 'active', '2025-04-30 09:35:47', '2025-04-30 09:35:47'),
(12, 'Megan Harris', NULL, 'The best travel management tool I’ve used. Highly recommend!', 5.00, 'Phoenix, AZ', 'active', '2025-04-30 10:50:28', '2025-04-30 10:50:28'),
(13, 'Steven Green', '', 'Good service, but the mobile app could use some improvements.', 4.00, 'Atlanta, GA', 'active', '2025-04-30 12:10:15', '2025-04-30 12:10:15'),
(14, 'Olivia Walker', NULL, 'Incredible experience! The team went above and beyond to help.', 5.00, 'Orlando, FL', 'active', '2025-04-30 13:25:39', '2025-06-17 01:01:15'),
(15, 'Daniel Adams', '', 'Solid platform with excellent features. Very satisfied overall.', 4.00, 'Dallas, TX', 'active', '2025-04-30 14:40:51', '2025-06-17 01:01:05');

-- --------------------------------------------------------

--
-- Table structure for table `tier_bookings`
--

CREATE TABLE `tier_bookings` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` int UNSIGNED DEFAULT NULL,
  `package_type` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `package_name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `package_price` decimal(10,2) NOT NULL,
  `first_name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `last_name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `city` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `state` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `zip` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `payment_method` varchar(255) COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'credit_card',
  `card_last_four` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `status` enum('pending','confirmed','cancelled') COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'pending',
  `notes` text COLLATE utf8mb4_general_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `travel_packages`
--

CREATE TABLE `travel_packages` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `short_description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `features` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin,
  `status` enum('active','inactive') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `sort_order` int NOT NULL DEFAULT '0',
  `is_featured` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ;

--
-- Dumping data for table `travel_packages`
--

INSERT INTO `travel_packages` (`id`, `name`, `type`, `slug`, `description`, `short_description`, `price`, `image`, `features`, `status`, `sort_order`, `is_featured`, `created_at`, `updated_at`) VALUES
(6, 'Membership For 1 (Domestic Travel)', 'pro-traveler', 'membership-for-1-domestic-travel', 'Membership For 1 (Domestic Travel)', 'Membership For 1 (Domestic Travel)', 99.00, NULL, '[\"Includes One Free Domestic Resort Booking\",\"Includes One Free Bonus Trip\"]', 'active', 1, 0, '2025-06-17 01:13:51', '2025-06-17 01:13:51');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `profile_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bio` text COLLATE utf8mb4_unicode_ci,
  `is_admin` tinyint(1) NOT NULL DEFAULT '0',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user_bookings`
--

CREATE TABLE `user_bookings` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `bundle_id` bigint UNSIGNED DEFAULT NULL,
  `booking_date` date NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notes` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `number_of_people` int NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `why_choose_us`
--

CREATE TABLE `why_choose_us` (
  `id` bigint UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `icon` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `color` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '#3b82f6',
  `sort_order` int NOT NULL DEFAULT '0',
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `why_choose_us`
--

INSERT INTO `why_choose_us` (`id`, `title`, `description`, `icon`, `color`, `sort_order`, `active`, `created_at`, `updated_at`) VALUES
(1, 'Trusted Vacations', 'A-rated by the Better Business Bureau with a 4.8-star Google rating', 'fas fa-check-circle', '#3b82f6', 0, 1, '2025-05-05 06:18:26', '2025-05-25 04:13:31'),
(2, 'Diverse Destinations', 'Over 50 top destinations across the U.S., Caribbean, Mexico, and beyond.', 'fas fa-globe', '#3b82f6', 2, 1, '2025-05-05 06:18:26', '2025-05-05 06:18:26'),
(3, 'U.S.-Based Support', 'Our dedicated team is here to assist you 24/7.', 'fas fa-flag-usa', '#3b82f6', 1, 1, '2025-05-05 06:18:26', '2025-05-25 04:13:31'),
(4, 'Affordable Quality', 'Premium accommodations at budget-friendly prices.', 'fas fa-dollar-sign', '#3b82f6', 3, 1, '2025-05-05 06:18:26', '2025-05-25 04:13:31');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `blogs`
--
ALTER TABLE `blogs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `blogs_slug_unique` (`slug`),
  ADD KEY `blogs_category_id_foreign` (`category_id`);

--
-- Indexes for table `blog_categories`
--
ALTER TABLE `blog_categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `blog_categories_slug_unique` (`slug`);

--
-- Indexes for table `blog_tag`
--
ALTER TABLE `blog_tag`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `blog_tag_blog_id_tag_id_unique` (`blog_id`,`tag_id`),
  ADD KEY `blog_tag_tag_id_foreign` (`tag_id`);

--
-- Indexes for table `bundles`
--
ALTER TABLE `bundles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `bundles_slug_unique` (`slug`);

--
-- Indexes for table `bundle_extras`
--
ALTER TABLE `bundle_extras`
  ADD PRIMARY KEY (`id`),
  ADD KEY `bundle_extras_bundle_id_foreign` (`bundle_id`);

--
-- Indexes for table `bundle_types`
--
ALTER TABLE `bundle_types`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `bundle_types_slug_unique` (`slug`);

--
-- Indexes for table `captcha_settings`
--
ALTER TABLE `captcha_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `comments_blog_id_foreign` (`blog_id`),
  ADD KEY `comments_user_id_foreign` (`user_id`);

--
-- Indexes for table `contact_settings`
--
ALTER TABLE `contact_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact_submissions`
--
ALTER TABLE `contact_submissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `custom_bundle_types`
--
ALTER TABLE `custom_bundle_types`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `custom_bundle_types_slug_unique` (`slug`);

--
-- Indexes for table `custom_destinations`
--
ALTER TABLE `custom_destinations`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `custom_destinations_slug_unique` (`slug`);

--
-- Indexes for table `deal_of_weeks`
--
ALTER TABLE `deal_of_weeks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `destinations`
--
ALTER TABLE `destinations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `destinations_bundle_id_foreign` (`bundle_id`);

--
-- Indexes for table `email_settings`
--
ALTER TABLE `email_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `email_subscriptions`
--
ALTER TABLE `email_subscriptions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `email_status_index` (`email`,`status`);

--
-- Indexes for table `email_verifications`
--
ALTER TABLE `email_verifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_email` (`email`);

--
-- Indexes for table `faqs`
--
ALTER TABLE `faqs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `navigation_items`
--
ALTER TABLE `navigation_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_navigation_items_parent` (`parent_id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `idx_email` (`email`);

--
-- Indexes for table `payment_gateways`
--
ALTER TABLE `payment_gateways`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `privacies`
--
ALTER TABLE `privacies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `settings_key_unique` (`key`);

--
-- Indexes for table `subscribers`
--
ALTER TABLE `subscribers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `subscribers_email_unique` (`email`);

--
-- Indexes for table `tags`
--
ALTER TABLE `tags`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `tags_slug_unique` (`slug`);

--
-- Indexes for table `testimonials`
--
ALTER TABLE `testimonials`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tier_bookings`
--
ALTER TABLE `tier_bookings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `travel_packages`
--
ALTER TABLE `travel_packages`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `travel_packages_slug_unique` (`slug`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `user_bookings`
--
ALTER TABLE `user_bookings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_bookings_user_id_foreign` (`user_id`),
  ADD KEY `user_bookings_bundle_id_foreign` (`bundle_id`);

--
-- Indexes for table `why_choose_us`
--
ALTER TABLE `why_choose_us`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `blogs`
--
ALTER TABLE `blogs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `blog_categories`
--
ALTER TABLE `blog_categories`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `blog_tag`
--
ALTER TABLE `blog_tag`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `bundles`
--
ALTER TABLE `bundles`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `bundle_extras`
--
ALTER TABLE `bundle_extras`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `bundle_types`
--
ALTER TABLE `bundle_types`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `captcha_settings`
--
ALTER TABLE `captcha_settings`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `contact_settings`
--
ALTER TABLE `contact_settings`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `contact_submissions`
--
ALTER TABLE `contact_submissions`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `custom_bundle_types`
--
ALTER TABLE `custom_bundle_types`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `custom_destinations`
--
ALTER TABLE `custom_destinations`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `deal_of_weeks`
--
ALTER TABLE `deal_of_weeks`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `destinations`
--
ALTER TABLE `destinations`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `email_subscriptions`
--
ALTER TABLE `email_subscriptions`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `email_verifications`
--
ALTER TABLE `email_verifications`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `faqs`
--
ALTER TABLE `faqs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `navigation_items`
--
ALTER TABLE `navigation_items`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `payment_gateways`
--
ALTER TABLE `payment_gateways`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `privacies`
--
ALTER TABLE `privacies`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `subscribers`
--
ALTER TABLE `subscribers`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tags`
--
ALTER TABLE `tags`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `testimonials`
--
ALTER TABLE `testimonials`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `tier_bookings`
--
ALTER TABLE `tier_bookings`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `travel_packages`
--
ALTER TABLE `travel_packages`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `why_choose_us`
--
ALTER TABLE `why_choose_us`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tier_bookings`
--
ALTER TABLE `tier_bookings`
  ADD CONSTRAINT `tier_bookings_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
