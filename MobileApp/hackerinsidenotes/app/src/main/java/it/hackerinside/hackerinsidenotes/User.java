package it.hackerinside.hackerinsidenotes;


import android.os.Parcel;
import android.os.Parcelable;
import android.util.Log;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.io.BufferedReader;
import java.io.DataOutputStream;
import java.io.InputStreamReader;
import java.io.Serializable;
import java.net.CookieManager;
import java.net.CookiePolicy;
import java.net.HttpURLConnection;
import java.net.URL;
import java.nio.charset.StandardCharsets;

public class User implements Serializable {
    public String UID;
    public CookieManager cookieContainer;

    public User() {
        cookieContainer = new CookieManager( null, CookiePolicy.ACCEPT_ALL );
    }

    public User(String UID, CookieManager cookieContainer) {
        this.UID = UID;
        this.cookieContainer = cookieContainer;
    }


    public static String httpPost(String urlstr,String params) throws Exception {

        byte[] postData = params.getBytes( StandardCharsets.UTF_8 );
        int postDataLength = postData.length;
        URL url = new URL( urlstr );
        HttpURLConnection conn= (HttpURLConnection) url.openConnection();
        conn.setDoOutput(true);
        conn.setInstanceFollowRedirects(false);
        conn.setRequestMethod("POST");
        conn.setRequestProperty("Content-Type", "application/x-www-form-urlencoded");
        conn.setRequestProperty("charset", "utf-8");
        conn.setRequestProperty("Content-Length", Integer.toString(postDataLength ));
        try(DataOutputStream wr = new DataOutputStream(conn.getOutputStream())) {
            wr.write( postData );
        }

        BufferedReader reader = new BufferedReader(new InputStreamReader(conn.getInputStream()));

        String inputLine,ris = "";
        while ((inputLine = reader.readLine()) != null) {
            System.out.println(inputLine);
            ris += inputLine;
        }

        reader.close();
        return ris;
    }

    public String login(String username, String password) throws Exception {
        final String[] ris = {""};
        Thread t = new Thread(new Runnable() {
            @Override
            public void run() {
                try{
                    ris[0] = httpPost("http://192.168.1.21/hackerinsidenotes/Backend/srv_controlloLogin.php",
                            "username=" + username + "&pwd=" + password);
                }catch(Exception e){

                }
                return;
            }
        });
        t.start();
        t.join();

        JSONObject jsonObj = new JSONObject(ris[0]);
        return jsonObj.getString("uid");
    }
    public String getNotes() throws Exception {
        final String[] ris = {""};
        final String uid = this.UID;
        Thread t = new Thread(new Runnable() {
            @Override
            public void run() {
                try{
                    ris[0] = httpPost("http://192.168.1.21/hackerinsidenotes/Backend/srv_getNotes.php",
                            "uid=" + uid);

                }catch(Exception e){

                }
                return;
            }
        });
        t.start();
        t.join();

        return ris[0];
    }

    public Nota getNote(String noteID) throws Exception {
        final String[] ris = {""};
        Thread t = new Thread(new Runnable() {
            @Override
            public void run() {
                try{
                    ris[0] = httpPost("http://192.168.1.21/hackerinsidenotes/Backend/srv_getNote.php",
                            "noteID=" + noteID);
                }catch(Exception e){

                }
                return;
            }
        });
        t.start();
        t.join();
        JSONArray ja = new JSONArray(ris[0]);
        JSONObject jsonObj = ja.getJSONObject(0);
        return new Nota(
                jsonObj.getString("ID"),
                jsonObj.getString("titolo"),
                jsonObj.getString("nota"),
                jsonObj.getString("dataSalvataggio"));
    }

    public int deleteNote(String noteID) throws Exception {
        final String[] ris = {""};
        Thread t = new Thread(new Runnable() {
            @Override
            public void run() {
                try{
                    ris[0] = httpPost("http://192.168.1.21/hackerinsidenotes/Backend/srv_deleteNote.php",
                            "noteID=" + noteID);
                }catch(Exception e){

                }
                return;
            }
        });
        t.start();
        t.join();
        JSONObject jsonObj = new JSONObject(ris[0]);
        return
                jsonObj.getInt("errorCode");
    }
    public int addNote(String title,String nota) throws Exception {
        final String[] ris = {""};
        Thread t = new Thread(new Runnable() {
            @Override
            public void run() {
                try{
                    ris[0] = httpPost("http://192.168.1.21/hackerinsidenotes/Backend/srv_addNote.php",
                            "titolo=" +title + "&nota=" + nota);
                }catch(Exception e){

                }
                return;
            }
        });
        t.start();
        t.join();
        JSONObject jsonObj = new JSONObject(ris[0]);
        return
                jsonObj.getInt("errorCode");
    }

    public int saveNote(String noteID,String title,String nota) throws Exception {
        final String[] ris = {""};
        Thread t = new Thread(new Runnable() {
            @Override
            public void run() {
                try{
                    ris[0] = httpPost("http://192.168.1.21/hackerinsidenotes/Backend/srv_editNote.php",
                            "noteID=" + noteID
                                    + "&titolo=" +title + "&nota=" + nota);
                }catch(Exception e){

                }
                return;
            }
        });
        t.start();
        t.join();
        JSONObject jsonObj = new JSONObject(ris[0]);
        return
                jsonObj.getInt("errorCode");
    }

}
