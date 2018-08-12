//public class SecondActivity {

package com.example.kevin.moodapp;


import android.app.Activity;
import android.os.Bundle;
import android.support.annotation.Nullable;
import android.view.View;
import android.widget.EditText;

import com.example.kevin.moodapp.BackgroundTask;

/**
     * Created by For on 4/14/2017.
     */

    public class SecondActivity extends Activity {
        EditText ET_USERNAME, ET_SLEEP_TIME, ET_SLEEP_QUALITY;
        String  username, sleep_time, sleep_quality;

        @Override
        protected void onCreate(@Nullable Bundle savedInstanceState) {
            super.onCreate(savedInstanceState);
            setContentView(R.layout.activity_second);
            ET_USERNAME = (EditText)findViewById(R.id.new_username);
            ET_SLEEP_TIME = (EditText)findViewById(R.id.new_sleep_time);
            ET_SLEEP_QUALITY = (EditText)findViewById(R.id.new_sleep_quality);

        }

     public void sleepData(View view)
     {
        username = ET_USERNAME.getText().toString();
        sleep_time = ET_SLEEP_TIME.getText().toString();
        sleep_quality = ET_SLEEP_QUALITY.getText().toString();
        String method = "sleeping";
         BackgroundTask backgroundTask = new BackgroundTask(this);
         backgroundTask.execute(method,username,sleep_time,sleep_quality);
         finish();



     }
    }
//}
