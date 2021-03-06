int trig = 10, echo = 9;
int led = 7;
void setup()
{
  pinMode(trig,OUTPUT);
  pinMode(echo,INPUT);
  pinMode(led, OUTPUT);
  Serial.begin(9600);
}
float distance(){
  digitalWrite(trig, HIGH);//bật
  delayMicroseconds(5); // xung phát ra trong 5 microSeconds
  digitalWrite(trig,LOW);//tắt
  int timer = pulseIn(echo, HIGH);
  return timer/58.3f; //quan trọng số 58,3 này ta cần xem cho đúng
}

void loop()
{
  Serial.println(distance());
  delay(1000);
}

/*
Đọc một xung tín hiệu digital (HIGH/LOW)
và trả về chu kì của xung tín hiệu,
tức là thời gian tín hiệu chuyển từ mức HIGH xuống LOW 
hoặc ngược lại (LOW -> HIGH).
Một số cảm biến như cảm biến màu sắc như TCS3200D
hay cảm biến siêu âm dòng HC-SRxx 
phải giao tiếp qua xung tín hiệu 
nên ta phải kết hợp giữa 2 hàm digitalWrite()
để xuất tín hiệu và pulseIn() để đọc tín hiệu.
*/

/*
pulseIn(pin, value);
pulseIn(pin, value, timeout);
Trong đó:
pin là chân được chọn để đọc xung. pin có kiểu dữ liệu là int.

Nếu đặt value là HIGH, 
hàm pulseIn() sẽ đợi đến khi tín hiệu đạt mức HIGH, 
khởi động bộ đếm thời gian. 
Khi tín hiệu nhảy xuống LOW, bộ đếm thời gian dừng lại.
pulseIn() sẽ trả về thời gian tín hiệu nhảy từ mức HIGH xuống LOW này. 
Nếu đặt value là LOW, hàm pulseIn() sẽ làm ngược lại, 
đó là đo thời gian tín hiệu nhảy từ mức LOW lên HIGH.
value có kiểu dữ liệu là int.

Nếu tín hiệu luôn ở một mức HIGH/LOW cố định
thì sau khoảng thời gian timeout, 
hàm pulseIn() sẽ dừng bộ đếm thời gian và trả về giá trị 0. 
timeout được tính bằng đơn vị micro giây. 
Giá trị mặc định của timeout là 60.106 tương ứng với 1 phút.
Giá trị tối đa là 180.106 tương ứng với 3 phút. 
timeout có kiểu dữ liệu là unsigned long.

Trả về
Một số nguyên kiểu unsigned long, đơn vị là micro giây.
pulseIn() trả về 0 
nếu thời gian nhảy trạng thái HIGH/LOW vượt quá timeout
*/