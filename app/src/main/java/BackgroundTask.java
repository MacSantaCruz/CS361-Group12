package com.example.kevin.moodapp;

import android.content.Context;
import android.os.AsyncTask;
import android.system.Os;
import android.widget.Toast;

import java.io.BufferedWriter;
import java.io.IOException;
import java.io.InputStream;
import java.io.OutputStream;
import java.io.OutputStreamWriter;
import java.net.HttpURLConnection;
import java.net.MalformedURLException;
import java.net.URL;
import java.net.URLEncoder;

public class BackgroundTask extends AsyncTask<String ,Void, String>{

    Context ctx;
    BackgroundTask(Context ctx)
    {
        this.ctx = ctx;

    }



    @Override
    protected void onPreExecute() {
        super.onPreExecute();
    }

    @Override
    protected String doInBackground(String... params) {

        String sleep_url = "http://web.engr.oregonstate.edu/~gwinnk/moodapp/sleepData.php";

        String method = params[0];
        if(method.equals("sleeping"))
        {
            String username = params[1];
            String sleep_time = params[2];
            String sleep_quality = params[3];
            try {
                URL url = new URL(sleep_url);
                HttpURLConnection httpURLConnection = (HttpURLConnection)url.openConnection();
                httpURLConnection.setRequestMethod("POST");
                httpURLConnection.setDoOutput(true);
                OutputStream Os = httpURLConnection.getOutputStream();
                BufferedWriter bufferedWriter = new BufferedWriter(new OutputStreamWriter(Os, "UTF-8"));
                String data = URLEncoder.encode("user", "UTF-8") + "=" + URLEncoder.encode(username, "UTF-8") + "&" +
                        URLEncoder.encode("sTime", "UTF-8") + "=" + URLEncoder.encode(sleep_time, "UTF-8") + "&" +
                        URLEncoder.encode("sQuality", "UTF-8") + "=" + URLEncoder.encode(sleep_quality, "UTF-8");
                bufferedWriter.write(data);
                bufferedWriter.flush();
                bufferedWriter.close();
                Os.close();

                InputStream IS = httpURLConnection.getInputStream();
                IS.close();
                return "data saved";

            }
            catch (MalformedURLException e) {
                e.printStackTrace();
            } catch (IOException e) {
                e.printStackTrace();
            }
        }
        return null;
    }

    @Override
    protected void onProgressUpdate(Void... values) {
        super.onProgressUpdate(values);
    }

    @Override
    protected void onPostExecute(String result) {
        Toast.makeText(ctx, result, Toast.LENGTH_LONG).show();
    }

    //public void execute(String method, String username, String sleep_time, String sleep_quality) {
    //}
}
//        username = ET_USERNAME.getText().toString();
  //              sleep_time = ET_SLEEP_TIME.getText().toString();
    //            sleep_quality = ET_SLEEP_QUALITY.getText().toString();
