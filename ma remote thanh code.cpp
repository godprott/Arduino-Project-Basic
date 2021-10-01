#include <iostream>
#include <fstream>
#include <string>
#include <iomanip> 

using namespace std;
 
int main()
{
	fstream f;
	f.open("input.txt", ios::in);
	
	fstream f2;
	f2.open("output.txt", ios::out);
	
	fstream f3;
	f3.open("output2.txt", ios::out);
 
 	if (f.fail())
	std::cout << "Failed to open this file in!" << std::endl;
	
	if (f2.fail())
	std::cout << "Failed to open this file out!" << std::endl;
	
	string data;
	
	double id_script = 1583920006993;
 	
 	int checker = 0;
	string line;
	f3<<"# REMOTE"<<endl;
	while (!f.eof())
	{
		if(checker==1)
		{
			f2<<"else"<<endl;
		}
		getline(f, line);
		
	int i=0;
	string data2,data3,tg;
	while(line[i]!='\0')
	{
		if(line[i]!='\t'){ //tab khac space
			tg+=line[i];
		}
		
		i++;
	}
	
	i=0;
	while(!(tg[i]=='0' && tg[i+1]=='x'))
	{
		data2+=tg[i];
		i++;
	}
	
	for(int j=i;j<tg.length();j++)
	data3+=tg[j];
	
	cout<<data2<<endl<<data3<<endl<<endl;
		
	f2<<"if(msgString==\""<<data2<<"\")"<<endl;
	f2<<"{"<<endl;
	f2<<"     Serial.println(\"SEND "<<data2<<"\");"<<endl;
	f2<<"     irsend.sendNEC("<<data3<<",32);"<<endl;
	f2<<"     delay(50);"<<endl;
	f2<<"}"<<endl;
	
		checker=1;
		
		
	f3<<fixed<<setprecision(0)<<"\'"<<id_script<<"\':"<<endl;
	f3<<"  alias: "<<data2<<endl;
	f3<<"  sequence:"<<endl<<"  - data:"<<endl;
	f3<<"      payload: \""<<data2<<"\""<<endl;
	f3<<"      topic: remote/command"<<endl;
	f3<<"    service: mqtt.publish"<<endl;
	
		
		

		data+="\n";
		data += line;
		
		id_script+=1;
	}
 
	f.close();
	f2.close();
	f3.close();
 
	cout << data;
}
