//package apriori;

import java.io.File;
import java.io.FileWriter;
import java.io.IOException;
import java.util.ArrayList;
import java.util.Arrays;
import java.util.Collections;
import java.util.HashMap;
import java.util.Scanner;

public class CandidateGen {
    static long startTime = System.nanoTime();
    static int callcount = 0;

public static void CandGen()
    {
        //HashMap map = new HashMap(); 
        try {
            String dataset = "parsed.txt";//determines name of file
            callcount = callcount +1;

            if(callcount == 1)
            {
            HashMap map = new HashMap();
            FileWriter Ck = new FileWriter("C"+callcount+".txt");
            FileWriter Infeq = new FileWriter("Infrequent.txt");
            FileWriter Feq = new FileWriter("Frequent.txt");

            Scanner list = new Scanner(new File(dataset)).useDelimiter(", ");
            while (list.hasNext()) {

                String word = list.next().trim();
                if (!list.hasNext()){
                    Feq.write("Time of execution : "+gettime()+" nano seconds"+System.getProperty("line.separator" ));
                    Infeq.write("Time of execution : "+gettime()+" nano seconds"+ System.getProperty("line.separator" ));
                    Ck.write("Time of execution : "+gettime()+" nano seconds"+ System.getProperty("line.separator" ));
                }               
                if(map.containsKey(word)) {
                  Integer count = (Integer)map.get(word);
                  map.put(word, new Integer(count.intValue() + 1));
                } else {
                   map.put(word, new Integer(1));
                }
              }
            ArrayList arraylist = new ArrayList(map.keySet());
            Collections.sort(arraylist);
            for (int i = 0; i < arraylist.size(); i++) {
              String key = (String)arraylist.get(i);
              Integer count = (Integer)map.get(key);

            if( count < Main.minSup)
            {
                Infeq.write(key  + System.getProperty( "line.separator" ));
            }
            else{
                Feq.write(key + System.getProperty( "line.separator" ));
                }
            Ck.write(key +" : "+count+System.getProperty( "line.separator" ));
               }
            //System.out.println("Frequent and Infrequent items separated to frequent.txt , infrequent.txt ");
            list.close();
            Infeq.close();
            Feq.close();
            Ck.close();
            SupportCounter.SupCoun();
        } 
        /// 2-itemset
            else if(callcount == 2){ // Write Ck
                String Lk = "L"+(callcount-1)+".txt";
                FileWriter Ck = new FileWriter("C"+callcount+".txt");
                HashMap map = new HashMap();
                Scanner list = new Scanner(new File(Lk));
                list.nextLine();

                while (list.hasNext()) {
                String word = list.next();

                if(map.containsKey(word)) {
                      Integer count = (Integer)map.get(word);

                      map.put(word, new Integer(count.intValue() + 1));
                    } else {
                       map.put(word, new Integer(1));
                    }
                list.nextLine();
                  }//while 

                ArrayList arraylist = new ArrayList(map.keySet());
                Collections.sort(arraylist);

                Ck.write("Time of execution : "+gettime()+" nano seconds"+ System.getProperty("line.separator" ));

                for (int i = 0; i < arraylist.size(); i++) {

                    for (int j = i+1; j < arraylist.size(); j++) {

                      String key = (String)arraylist.get(i);
                      String key2 = (String)arraylist.get(j);
                      Ck.write(key + " " + key2 + System.getProperty( "line.separator" ));
                   // System.out.println(key + "," + key2 );
                    }
                }
                Ck.close();
                countfre(callcount);
                SupportCounter.SupCoun();
            }//else-if end

    /// 3-itemset
            else if(callcount >2){
            String Lk = "L"+(callcount-1)+".txt";
            FileWriter Ck = new FileWriter("C"+callcount+".txt");
            Scanner list = new Scanner(new File(Lk));
            Scanner list2 = new Scanner(new File(Lk));
            list.nextLine();
            int c=0;
            ArrayList arraylist= new ArrayList();
            ArrayList arraylist2= new ArrayList();
            //HashMap map = new HashMap();

            while(list.hasNext())
            {
                String word = list.next();
                c++;
                //System.out.println(word);
                if(word.contains(":"))
                {
                    list.nextLine();
                    c=0;
                    continue;
                }
                else if(c == callcount)
                {
                    if(list.hasNext())
                    {

                    list.nextLine();
                    continue;
                    }
                    else
                        break;
                }
                //System.out.println(word);
                arraylist.add(word);
                }

            list2.nextLine();
            list2.nextLine();
            while(list2.hasNext())
            {
                String word = list2.next();
                c++;
                //System.out.println(word);
                if(word.contains(":"))
                {
                    list2.nextLine();
                    c=0;
                    continue;
                }
                else if(c == callcount)
                {
                    if(list2.hasNext())
                    {

                    list2.nextLine();
                    continue;
                    }
                    else
                        break;
                }
                //System.out.println(word);
                arraylist2.add(word);

            }
            int el = 0;
            String set3,set4;
            ArrayList arraylist3= new ArrayList();
            //Scanner scanarray = new Scanner((Readable) arraylist2);
            for(int i=0;i<arraylist.size();i++)
            {

                c++;
                set3 = (String) arraylist.get(i);
                for(int j=0;j<(arraylist2.size());j++)
                {

                    set4 = (String)arraylist2.get(j);
                    if(set3.contains(set4))
                        {
                            //System.out.println(i+" "+j);
                            i++;
                            //System.out.println(i+" "+j);
                            //j++;
                            //System.out.println(i-1+" "+i+" "+(j+1)+"-");
                            String w = (String)arraylist.get(i-1);
                            String w2 = (String) arraylist.get(i);
                            //j++;
                            String w3 = (String) arraylist2.get(j+1);
                            System.out.println(w +" "+w2+" "+w3);
                            Ck.write(w+" "+w2+" "+w3+System.getProperty("line.separator"));
                            arraylist3.add(w);
                            arraylist3.add(w2);
                            arraylist3.add(w3);
                            el++;

                            //System.out.println(el);
                        }
                    i=i+1;
                    //j=j+2;
                    }
                //  j=j=0;
                }
            for(int i=0;i<el;i++)
            {
            //  System.out.println(arraylist3.get(i));
            }
            //}
            Ck.close();

            countfre(callcount);

        }//else-if end

    }
        catch (IOException e) 
        {
            e.printStackTrace();
        }


    }

private static void countfre(int filenumber) throws IOException{

    ArrayList<String> ckwords = new ArrayList<String>();
    ArrayList<String> dbwords = new ArrayList<String>();

    File ck = new File("C2.txt");
     Scanner ckscan = new Scanner(ck);//.useDelimiter(":");

     File dataset = new File("dataset.txt");
     Scanner dbscan = new Scanner(dataset).useDelimiter("\n");

     int j1,i1 =0;
     ckscan.nextLine();
     while(dbscan.hasNext())
     {
         String wrd = dbscan.nextLine();
         dbwords.add(wrd);
     }
     while(ckscan.hasNext())
     {
         String wrd2 = ckscan.nextLine();
         ckwords.add(wrd2);
     }
     int counter =0;
     ckscan = new Scanner(ck);//.useDelimiter(":");
     ckscan.nextLine();
     while(ckscan.hasNext())
     {
         dbscan = new Scanner(dataset).useDelimiter("\n");
         String wrd2 = ckscan.nextLine();
         ckwords.add(wrd2);
         for(j1=0;j1<dbwords.size();j1++){
             if(dbwords.get(j1).contains(wrd2)){
                 counter++;
             }

     }
 //      System.out.println(wrd2+"--"+counter);
  //  System.out.println("--------------------------------------------------------------");
     }
  }




    // END of TIMER
    public static   double gettime()
    {
        long endTime   = System.nanoTime();
        double totalTime = (double) ((endTime - startTime));
        return (double) (totalTime);
    }
}