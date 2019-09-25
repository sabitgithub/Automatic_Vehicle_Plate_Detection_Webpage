# Automatic_Vehicle_Plate_Detection_Webpage

I have done an Automation System that named “Automatic Vehicle Plate Detection for Fast Parking/ Toll Collection / Security”. The system mainly captures vehicle image from runtime video and recognize the character using google vision API. I have applied some own algorithm for pattern recognition to extract actual character and avoid garbage value. After getting characters send this data to the cloud via API. For hardware implementation I used python. Python code is implemented in Rasberry pi 3 B+.
For displaying result and output I made a website which is used php for web pages, JS(JavaScript) for implementation some methods, Ajax for changing data on same page. I have storied all data in database for Vehicle LogBook using MYSQL. There is an option for checking logbook and print or save from website. If the vehicle number is matched with database, the website sends an open status to the cloud.
The hardware retrieves cloud data asynchronously to get update result.  
 


