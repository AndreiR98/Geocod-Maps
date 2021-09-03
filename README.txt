Go to lib/config.php for API_KEY and MySQL datas

add adress.sql to MySQL database

When you are on the front page you can type some adress for example Strada Victoriei 24, Pitești 110017 this adress is for Pitesti's Townhall

This adress is not in the database

If adress is corect then some informations will show up:

Adress: Strada Victoriei 24, Pitești, Romania
Latitude: 44.8586452
Longitude: 24.870492
Generate in: 694.5 ms

Those informations were generated in 694.5ms because the desired adress is not in database

Now if we go and type the same adress or it's Lat. and Long. coords:

Adress: Strada Victoriei nr 24, Pitești, Romania
Latitude: 44.858635
Longitude: 24.870479
Generate in: 37.60000014305115 ms

Since the adress is stored in the database now it's generated in only ~38 ms