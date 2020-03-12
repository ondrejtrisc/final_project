<?php

$territories = [

   "alaska" => ["northwest_territory", "alberta", "kamchatka"],
   "northwest_territory" => ["alaska", "alberta", "ontario", "greenland"],
   "greenland" => ["northwest_territory", "ontario", "quebec", "iceland"],
   "alberta" => ["alaska", "northwest_territory", "ontario", "western_united_states"],
   "ontario" => ["northwest_territory", "greenland", "alberta", "quebec", "western_united_states", "eastern_united_states"],
   "quebec" => ["greenland", "ontario", "eastern_united_states"],
   "western_united_states" => ["alberta", "ontario", "eastern_united_states", "central_america"],
   "eastern_united_states" => ["ontario", "quebec", "western_united_states", "central_america"],
   "central_america" => ["western_united_states", "eastern_united_states", "venezuela"],

   "venezuela" => ["brazil", "peru", "central_america"],
   "peru" => ["brazil", "argentina", "venezuela"],
   "brazil" => ["argentina", "peru", "venezuela", "north_africa"],
   "argentina" => ["brazil", "peru"],
   
   "iceland" => ["greenland", "scandinavia", "great_britain"],
   "scandinavia" => ["iceland", "great_britain", "northern_europe", "ukraine"],
   "great_britain" => ["iceland", "scandinavia", "northern_europe", "western_europe"],
   "northern_europe" => ["scandinavia", "great_britain", "western_europe", "southern_europe", "ukraine"],
   "western_europe" => ["great_britain", "northern_europe", "southern_europe", "north_africa"],
   "southern_europe" => ["northern_europe", "western_europe", "ukraine", "north_africa", "egypt", "middle_east"],
   "ukraine" => ["scandinavia", "northern_europe", "southern_europe", "ural", "afghanistan", "middle_east"],
   
   "north_africa" => ["brazil", "western_europe", "southern_europe", "egypt", "east_africa", "congo"],
   "egypt" => ["southern_europe", "north_africa", "middle_east", "east_africa"],
   "east_africa" => ["north_africa", "egypt", "middle_east", "congo", "south_africa", "madagascar"],
   "congo" => ["north_africa", "east_africa", "south_africa"],
   "south_africa" => ["congo", "east_africa", "madagascar"],
   "madagascar" => ["east_africa", "south_africa"],
   
   "ural" => ["ukraine", "siberia", "afghanistan", "china"],
   "siberia" => ["ural", "yakursk", "irkutsk", "china", "mongolia"],
   "yakursk" => ["siberia", "irkutsk", "kamchatka"],
   "irkutsk" => ["siberia", "yakursk", "kamchatka", "mongolia"],
   "kamchatka" => ["alaska", "yakursk", "irkutsk", "mongolia", "japan"],
   "afghanistan" => ["ukraine", "ural", "china", "middle_east", "india"],
   "china" => ["ural", "siberia", "afghanistan", "mongolia", "india", "siam"],
   "mongolia" => ["siberia", "irkutsk", "kamchatka", "china", "japan"],
   "japan" => ["kamchatka", "mongolia"],
   "middle_east" => ["southern_europe", "ukraine", "egypt", "east_africa", "afghanistan", "india"],
   "india" => ["afghanistan", "china", "middle_east", "siam"],
   "siam" => ["china", "india", "indonesia"],
   
   "indonesia" => ["siam", "new_guinea", "western_australia"],
   "new_guinea" => ["indonesia", "western_australia", "eastern_australia"],
   "western_australia" => ["indonesia", "new_guinea", "eastern_australia"], 
   "eastern_australia" => ["new_guinea", "western_australia"],
];

//consistency test
foreach ($territories as $territory => $neighbours) {
   foreach ($neighbours as $neighbour) {
      if (array_search($territory, $territories[$neighbour]) === false) {
         echo 'territory: ' . $territory . '<br>';
         echo 'neighbour: ' . $neighbour . '<br>';
      }
   }
}