#include <iostream>

using namespace std;

//Interface
class IQueuable
{
public:
    virtual void enqueue(string value) = 0;
    virtual void dequeue() = 0;
    virtual void getQueue() = 0;
    virtual int size() = 0;
};

class Node
{
public:
    string data;
    Node *next;

    Node(string val){
        data = val;
        next = NULL;
    }
};

class Queue: public IQueuable
{
private:
    Node *front, *back;

public:
       
    Queue(){
        front = back = NULL;
    }

    void enqueue(string val)
    {
        Node *n = new Node(val);

        //===============Insertion process==============//
        //If both front and back pointer is NULL (Queue is empty)
        if(front == NULL || back == NULL){
            front = back = n;
        }
        //If front or back pointer is not NULL (Queue is not empty)
        else{
            back->next = n;
            back = n;
        }
    }

    void dequeue()
    {
        //If deletion process lead to front = NULL, then change back to NULL too
        if(front == NULL){
            back = NULL;
            cout << "Queue is empty\n";
        }else{
            Node *temp = front;
            front = front->next;

            free(temp);
        }
    }

    void getQueue(){
        Node *temp = front;

        cout << "List of queue is: ";
        while(temp != NULL){
            cout << temp->data << " ";
            temp = temp->next;
        }
        cout << "\n";
    }

    int size(){
        Node *temp = front;
        int count = 0;

        //Traverse the whole queue in order to get size of the queue
        while(temp != NULL){
            count++;
            temp = temp->next;
        }
        return count;
    }
};

class Stack: public IQueuable
{
private:
    Node *top;

public:
       
    Stack(){
        top = NULL;
    }

    void enqueue(string val)
    {
        Node *n = new Node(val);

        //=======Insertion process (At the front)=======//
        n->next = top;
        top = n;
    }

    void dequeue()
    {
        if(top == NULL){
            cout << "Stack is empty";
        }else{
            Node *temp = top;
            top = top->next;

            free(temp);
        }
    }

    void getQueue(){
        Node *temp = top;

        cout << "List of stack is: ";
        while(temp != NULL){
            cout << temp->data << " ";
            temp = temp->next;
        }
        cout << "\n";
    }

    int size(){
        Node *temp = top;
        int count = 0;

        //Traverse the whole stack in order to get size of the stack
        while(temp != NULL){
            count++;
            temp = temp->next;
        }
        return count;
    }
};

int main()
{
    Stack q;

    q.enqueue("Muhammad");
    q.enqueue("Bazly");
    q.enqueue("Bin");
    q.enqueue("Burhan");

    cout << q.size() << endl;

    q.getQueue();

    q.dequeue();

    q.getQueue();


    return 0;
}