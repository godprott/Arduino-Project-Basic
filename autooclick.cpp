#include <iostream>
#include <windows.h>
 
using namespace std;
 
 
int main(int argc, char * argv[])
 
{
    int n = 1;
    int x;   
    int y;
    int times;   
    int done;
    int sleepy;
    int llol;
    string choice;
 	POINT point;
 
    start:
 
 
    cout << "So lan cick" << endl;
    cout << "   " << endl;
 
  
 
cin>>times;
cout<<"check or run? (run = 1)(check==0)"<<endl;
cin>>llol;
 
sleepy=1000;
done = 0;
 
cout << "starting in 5..." << endl;
Sleep(1000);
cout << "starting in 4..." << endl;
Sleep(1000);
cout << "starting in 3..." << endl;
Sleep(1000);
cout << "starting in 2..." << endl;
Sleep(1000);
cout << "starting in 1..." << endl;
Sleep(1000);
 
    while (done <= times)
    {
        Sleep(sleepy);
        /*keybd_event(VK_SPACE, 0x20, KEYEVENTF_EXTENDEDKEY | 0, 0);
         Sleep(200);
        keybd_event( VK_NUMLOCK, 0x45, KEYEVENTF_EXTENDEDKEY | KEYEVENTF_KEYUP, 0);
        Sleep(200);*/
        
if (GetCursorPos(&point)) {
  cout << point.x << "," << point.y << "\n";
}
if(llol==0)
sleepy=9;
		if(llol==1)
		{
       SetCursorPos(825,1030);
       mouse_event(MOUSEEVENTF_LEFTDOWN, x, y, 0, 0);
        Sleep(200);
        mouse_event(MOUSEEVENTF_LEFTUP, x, y, 0, 0);
        
         Sleep(2000); //for honor 2000s
        
         SetCursorPos(1150,860);
       mouse_event(MOUSEEVENTF_LEFTDOWN, x, y, 0, 0);
        Sleep(200);
        mouse_event(MOUSEEVENTF_LEFTUP, x, y, 0, 0);
        
         Sleep(3000);
        
        SetCursorPos(1122,930);
       mouse_event(MOUSEEVENTF_LEFTDOWN, x, y, 0, 0);
        Sleep(200);
        mouse_event(MOUSEEVENTF_LEFTUP, x, y, 0, 0);
        //-----------------------------------------
        
        Sleep(3000);
        
        SetCursorPos(862,567);
       mouse_event(MOUSEEVENTF_LEFTDOWN, x, y, 0, 0);
        Sleep(200);
        mouse_event(MOUSEEVENTF_LEFTUP, x, y, 0, 0);
          Sleep(3000);
        
        SetCursorPos(572,630);
       mouse_event(MOUSEEVENTF_LEFTDOWN, x, y, 0, 0);
        Sleep(200);
        mouse_event(MOUSEEVENTF_LEFTUP, x, y, 0, 0);
           Sleep(2000);
        
        SetCursorPos(1008,791);
       mouse_event(MOUSEEVENTF_LEFTDOWN, x, y, 0, 0);
        Sleep(200);
        mouse_event(MOUSEEVENTF_LEFTUP, x, y, 0, 0);
    }
        done++;
        
      
        
                
    }
 
   
   		
   		
    
     
     
     
    cout << "    " << endl;
    Sleep(1000);
    cout << "Again?   (y) or (n)" << endl;
    cin >> choice;
 
  
 
    if (choice == "y")
    {
 
        system("cls");
        goto start;
 
 
    }
 
    cin.get();
 
 
    //This should have worked, lets see if I made any mistakes
}
