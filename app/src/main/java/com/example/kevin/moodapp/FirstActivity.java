package com.example.kevin.moodapp;

import android.content.Intent;
import android.os.Bundle;
import android.support.v7.app.AppCompatActivity;
import android.view.View;
import android.widget.Button;
import android.widget.TextView;

public class FirstActivity extends AppCompatActivity {
    TextView textView;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_first);
        textView = (TextView) findViewById(R.id.text);

    }



    public void Ganesh(View View)
    {
        String button_text;
        button_text =((Button)View).getText().toString();
        if(button_text.equals("click second activity"))
        {
            Intent ganesh = new Intent(this, com.example.kevin.moodapp.SecondActivity.class);
            startActivity(ganesh);
        }
        else if (button_text.equals("click third activity"))
        {
            Intent mass = new Intent(this, com.example.kevin.moodapp.ThirdActivity.class);
            startActivity(mass);

        }
    }
}
