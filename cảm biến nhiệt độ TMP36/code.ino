
int value ;
float v_out;
void setup()
{
  
  Serial.begin(9600);
}

void loop()
{
 
  
  value= analogRead(A0);
  v_out = value  * 5 / 1024.0;
  v_out = v_out - 0.5;
  float temp = v_out * 100;
  Serial.println(temp);
  delay(1000);
}

/*
Chân số 1 là chân cấp nguồn 5V (chân này bạn có thể cắm vào nguồn 5V của Arduino khi sử dụng nó với Arduino).
Chân thứ 2 là chân xuất tín hiệu tương tự (tín hiệu dạng xung). nên phải dùng chân analog
Chân thứ 3 là chân nối mát hay chân GND(khi sử dụng với Arduino các bạn có thể lấy từ chân Gnd từ Arduino.
*/

/*
Đầu vào tương tự cho chúng ta một giá trị trong khoảng từ 0 đến 1023, 0 là không có điện áp và 1023 là 5V. Để tìm ra điện áp này chuyển đổi thành độ Celsius, trước tiên chúng ta sẽ cần tìm phần trăm 5V trên đầu vào. Điều này có thể được thực hiện bằng cách chia cảm biến Input cho 1024.

cảm biến này qui định sẽ xuất 0 - 1,75V trong phạm vi 175 độ (-50 ° đến 125 °) cho chân analog để nó đọc, nghĩa là cứ 0,01V bằng 1 độ. Chúng ta sẽ cần phải chuyển đổi tỷ lệ phần trăm của đầu vào thành điện áp bằng cách nhân với 5V.

Vì 0 - 1,75V trong phạm vi 175 độ là 0 ° - 175 °, chúng ta sẽ cần thay đổi giá trị đầu ra sao cho số đọc tối thiểu -50 ° bằng với giá trị điện áp bằng 0. Chúng tôi thực hiện điều này bằng cách trừ 0,5 từ điện áp đầu ra. Giá trị mới của chúng tôi hiện dao động từ -0,5 đến 1,25 (trông khá giống với phạm vi nhiệt độ -50 ° đến 125 °)

Để chuyển đổi từ millivolts sang độ C, chúng ta sẽ cần nhân với 100.
*/