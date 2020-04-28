#include <ESP8266WiFi.h> 
#include <ESP8266WiFiMulti.h>
#include <ESP8266HTTPClient.h> 
ESP8266WiFiMulti WiFiMulti; 

void setup() {
  int k=0;
  WiFiMulti.addAP("NAZWA_SIECI_WIFI", "HASLO_SIECI_WIFI"); 
  while ((WiFiMulti.run() != WL_CONNECTED)) { //oczekiwanie na polaczenie
    delay(200); //odczekanie 200ms do kolejnego sprawdzenia czy upolaczono z siecia
    k++;
    if(k>200)
    ESP.deepSleep(0); 
    
  }
  if ((WiFiMulti.run() == WL_CONNECTED)) { //sprawdzenie czy polaczono z siecia
    HTTPClient http; //ustalenie zmiennej polaczenia jako klijent
    String content = "http://nazwawitryny.pl/projekt_esp/add.php?"; //utworzenie zmiennej której zawartość zostanie potem wykorzystana do polaczenia
    

    http.begin(content); //wykonanie polaczenia z wykorzystaniem zmiennej
    int httpCode = http.GET(); //odczytywanie informacji o polaczeniu z strona
 
    http.end(); //zakonczenie polaczenia
  }


ESP.deepSleep(0); 

  
}

void loop() {}
