package it.hackerinside.hackerinsidenotes;


import org.json.JSONException;
import org.json.JSONObject;

import java.io.BufferedReader;
import java.io.DataOutputStream;
import java.io.InputStreamReader;
import java.net.CookieManager;
import java.net.CookiePolicy;
import java.net.HttpURLConnection;
import java.net.URL;
import java.nio.charset.StandardCharsets;

public class User {
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
        return null;
    }

    public String login(String username, String password) throws Exception {
        JSONObject jsonObj = new JSONObject(httpPost("http://192.168.1.21/hackerinsidenotes/Backend/srv_controlloLogin.php",
                "username=" + username + "&pwd=" + password));
        return jsonObj.getString("uid");
    }
    public String getNotes() throws Exception {
        /*JSONObject jsonObj = new JSONObject();
        return jsonObj.getString("uid");*/
        return httpPost("http://192.168.1.21/hackerinsidenotes/Backend/srv_getNotes.php",
                "uid=" + this.UID);
    }
}
