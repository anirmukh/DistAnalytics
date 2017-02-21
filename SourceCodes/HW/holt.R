setwd("C://xampp/htdocs//API//PAGES//HW")
library("lubridate")
library("plyr")
library("forecast")
args <- commandArgs(TRUE)
period<-args[1]
type<-args[2]
activation1 <- read.csv("C:/xampp/htdocs/API/PAGES//HW/file.csv", header=TRUE) #Load the file on total sales count per day
activation<-data.frame(activation1$DATE,activation1$SALES,activation1$ITEM.NAME);
colnames(activation)<-c("Sale_Date","Sale_Count","Item_Name");
activation$Sale_Date <- as.Date(activation$Sale_Date) #Converting the dates to date field
class(activation$Sale_Date)
activation$Sale_Count=as.numeric(as.character(activation$Sale_Count))
if(type==0){
activation$week <- floor_date(activation$Sale_Date, "day")
weeklyMean<-ddply(activation, .(week),function(activation) mean(activation$Sale_Count,na.rm=TRUE))
weeklyMean$weeknum <- as.numeric(format(weeklyMean$week, "%j"))
}else if(type==1){
  activation$week <- floor_date(activation$Sale_Date, "week")
  weeklyMean<-ddply(activation, .(week), function(activation) mean(activation$Sale_Count,na.rm=TRUE))
  weeklyMean$weeknum <- as.numeric(format(weeklyMean$week, "%U"))
}else {
  activation$week <- floor_date(activation$Sale_Date, "month")
  weeklyMean<-ddply(activation, .(week), function(activation) mean(activation$Sale_Count,na.rm=TRUE))
  weeklyMean$weeknum <- as.numeric(format(weeklyMean$week, "%m"))
}
#Getting the week number
act <- weeklyMean$V1 #getting the sale count(mean)
count<-cbind(weeklyMean$weeknum,act)
if(type==0){
colnames(count)<-c("Day Number","Sales Count")
}else if (type==1){
colnames(count)<-c("WeekNumber","Sales Count") 
}else{
colnames(count)<-c("Month Number","Sales Count")
}
count<-as.data.frame(count)
write.csv(count,"sales.csv")
a<- c(weeklyMean$weeknum) #getting the first week
actTS <- ts(act,freq=1, start=c(a[1],1)) #Creating the time series
actTS<-actTS[complete.cases(actTS)]
#plot.ts(actTS) #plot the forecast
actforecast <- HoltWinters(actTS, beta=FALSE, gamma=FALSE)
#plot(actforecast)
actforecast2 <- forecast.HoltWinters(actforecast, h=period) 
x=as.data.frame(actforecast2)
out=cbind(x$`Point Forecast`,x$`Lo 80`,x$`Hi 80`,x$`Lo 95`,x$`Hi 95`)
colnames(out)<-c("Coefficient","Lo 80","Hi 80","Lo 95","Hi 95")
write.table(out,"fin.csv")
png(filename="forcasting.png")
plot(actforecast2)
dev.off()
file.remove("file.csv")

