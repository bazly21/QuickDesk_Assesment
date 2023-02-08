#include <iostream>

using namespace std;

//Interface
class IQueuable
{
public:
    virtual string* enqueue(string value) = 0;
    virtual string dequeue() = 0;
    virtual string* getQueue() = 0;
    virtual int size() = 0;
};

class Queue: public IQueuable{
private:
    string* queue;
    int front = 0, back = 0, s;

public:

    //Constructor of Queue Class
    Queue(int no){
        s = no;
        queue = new string [s];
    } 

    //Destructor of Queue Class
    ~Queue(){
        delete [] queue;
    }

    //Create enqueue function to add value to the queue
    string* enqueue(string value){
        if(back == 10-1){
            cout << "Queue is full!\n";
        }else{
            queue[back++] = value;
        }
    
        return queue;
    }

    string dequeue(){      
        if(front == back){
            cout << "Queue is empty!\n";
        }else{
            //Create temporary variable to store front value;
            string temp = queue[front];

            //Use for-loop to remove front data by moving other data to the front
            for(int i = front; i < back-1; i++){
                queue[i] = queue[i+1];
            }

            back--;

            return temp;
        }   

        return ""; 
    }

    //Create getQueue function to display data of the queue;
    string* getQueue(){
        return queue;
    }

    //Create size function to get the size of the queue
    int size(){
        return back;
    }
};


class Stack: public IQueuable{
private:
    string* stack;
    int top = 0, s;

public:

    //Constructor of Stack class
    Stack(int no){
        s = no;
        stack = new string [s];
    }

    //Destructor of Stack class
    ~Stack(){
        delete [] stack;
    }

    string* enqueue(string value){
        if(top >= s){
            cout << "Queue is full!\n";
        }else{
            stack[top] = value;
            top++;
        }
    
        return stack;
    }

    string dequeue(){      
        if(top == 0){
            cout << "Stack is empty!\n";
        }else{
            //Create temporary variable to store top value;
            string temp = stack[top-1];
            top--;

            return temp;
        }   

        return ""; 
    }

    //Create getQueue function to display data of the stack;
    string* getQueue(){
        return stack;
    }

    //Create size function to get the size of the stack
    int size(){
        return top;
    }
};
