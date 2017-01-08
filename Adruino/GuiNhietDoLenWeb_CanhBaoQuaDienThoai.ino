#include <SoftwareSerial.h>

SoftwareSerial mySerial(10, 11);//TX, RX
int SensorPin = A0; //Khai bao chan analog ket noi den Sensor
String messageTem;

void setup() {
  Serial.begin(9600);
  mySerial.begin(9600);
  delay(200);

  //Ngat ket noi GPRS tren sim808 tranh truong hop da ket noi tu truoc
  mySerial.println("AT+CIPSHUT\r");
  delay(5000);
  
  //Gui goi tin nay 1 lan de bao thong tin tram
  mySerial.println("AT+CIPSTART=\"TCP\",\"171.232.116.200\",\"1988\"");
  delay(8000);
  //mySerial.println("AT+CIPSTART=\"TCP\",\"smfiot.ddns.net\",\"1334\"");
  //delay(8000);
  
  mySerial.println("AT+CIPSEND\r");
  delay(100);
  mySerial.println("{\"type\" : \"selectdb\", \"dbname\" : \"farm1\", \"areaid\" : \"1\", \"plantid\" : \"1\"}");
  mySerial.write(0x1A);
  delay(100);
  mySerial.println();
}

  void loop() {
  //Doc nhiet do
  int readingTem = analogRead(SensorPin); //Doc gia tri tu cam bien LM35
  float voltage = readingTem * 5.0 / 1024.0;//tinh gia tri hieu dien the tu cam bien
  float tem = voltage * 100.0; //cu 1mV = 10 do C
  messageTem = String(tem);
  Serial.print("Nhiet do: \t");
  Serial.println(tem);
  delay(3000); //3 s doc 1 lan

  //Gui thong tin len web
  mySerial.println("AT+CIPSEND\r");
  delay(100);
  mySerial.print("{\"type\" : \"data\", \"temp\" :\"");
  mySerial.print(messageTem);
  mySerial.println("\"}");
  mySerial.write(0x1A);
  mySerial.println();
  delay(100);
  
  //Gui thong bao neu nhiet do do am vuot qua muc cho phep toi dien thoai
  
  if(tem >= 50.0)
  {
    mySerial.print("AT+CMGF=1\r");
    delay(100);
    mySerial.println("AT+CMGS=\"+84977001053\"");
    delay(100);
    mySerial.print("Nhiet do vuot qua muc cho phep ");
    mySerial.print(tem);
    mySerial.println(" do C");
    mySerial.write(0x1A);
    mySerial.println();
    delay(1000);

    //Ket noi lai
    //mySerial.println("AT+CIPSTART=\"TCP\",\"smfiot.ddns.net\",\"1334\"");
    //delay(3000);
    mySerial.println("AT+CIPSTART=\"TCP\",\"171.232.116.200\",\"1988\"");
    delay(3000);
    mySerial.println("AT+CIPSEND\r");
    delay(100);
    mySerial.println("{\"type\" : \"selectdb\", \"dbname\" : \"farm1\", \"areaid\" : \"1\", \"plantid\" : \"1\"}");
    mySerial.write(0x1A);
    delay(100);
    mySerial.println();
   }
}
