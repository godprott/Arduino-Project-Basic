int x;
int check=1;
int y;
int previous_button = 0 ; 
int current_button ;
int count = 0;
void setup()
{
  
	pinMode(12, INPUT);
  pinMode(6,OUTPUT);
  Serial.begin(9600);
}
void loop()
{
 
 current_button = digitalRead(12);
  if(current_button == LOW && previous_button == HIGH){
    count = count + 1;
  }
  previous_button = current_button;
  if(count % 2 ==0 ) digitalWrite(6, HIGH);
  else
    digitalWrite(6, LOW);

  
}

/*
khi đặt chân 12 thành INPUT nó sẽ ko truyền ra tý điệm nào cả,
mà nó bắt điện từ bên ngoài truyền vào để xử lý, do đó nếu nó nhận
dc điện truyền vào nó là HIGH, ko nhận dc là LOW
*/

/*
ở nút button có gắn 1 trở, lý do là điện 5V truyền vào, nếu button
nhấn thì nó đi qua trở và về đầu âm (GND - đất) 

nếu ko có trở thì nó bị ngắn mạch gây nổ vì mạch R=0 => I = vô cùng
mạch nổ (I = U/R)


*/