int button_pin = 12;
int button_value ;
int yellow = 6, red = 5, blue = 4;
int previous_button = 0 ; 
int current_button ;
int count = 0;
void setup()
{
  pinMode(button_pin, INPUT);
  pinMode(yellow, OUTPUT);
  pinMode(red, OUTPUT);
  pinMode(blue, OUTPUT);
  Serial.begin(9600);
}

void loop()
{
  current_button = digitalRead(button_pin);
  if(current_button == LOW && previous_button == HIGH){
    count = count + 1;
  }
  previous_button = current_button;
  if(count == 1 ) digitalWrite(yellow, HIGH);
  if(count == 2){
    digitalWrite(yellow, LOW);
    digitalWrite(red, HIGH);
  }
  if(count == 3) {
    digitalWrite(red, LOW);
    digitalWrite(blue, HIGH);
  }
  if(count == 4){
    digitalWrite(yellow, HIGH);
    digitalWrite(red, HIGH);
  }
  if(count ==5 ){
    digitalWrite(yellow, LOW);
    digitalWrite(red, LOW);
    digitalWrite(blue, LOW);
  }
  if(count == 6) count = 1;
  /*
  if(count % 2 == 0 ) digitalWrite(led_pin , LOW);
  else digitalWrite(led_pin , HIGH); 
  */
  
}