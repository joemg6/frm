class _TimeRP
{

    constructor(unixtime)
    {
        this.unixTimex = unixtime;
        this.x = document.getElementById("time");
    }

    formatTime()
    {
        let date = new Date(this.unixTimex * 1000);
        let str_day = date.getDate().toString();
        let str_hour = date.getHours().toString();
        let str_minute = date.getMinutes().toString();
        let str_second = date.getSeconds().toString();
        let a;
        if (str_day.length == 1)
            str_day = `0${str_day}`;
        let str_month = date.getMonth();
        str_month = str_month + 1;
        str_month = str_month.toString();
        if (str_month.length == 1)
            str_month = `0${str_month}`;
        if (str_second.length == 1)
            str_second = `0${str_second}`;
        if (str_minute.length == 1)
            str_minute = `0${str_minute}`;
        if (str_hour.length == 1)
            str_hour = `0${str_hour}`;
        (str_hour >= 12) ? a = 'pm': a = 'am';
        date = `${str_day}-${str_month}-${date.getFullYear()} ${str_hour}:${str_minute}:${str_second} ${a}`;
        return date;
    }

    showTime()
    {
        this.x.innerHTML = this.formatTime();
        setTimeout(this.showTime.bind(this), 1000);
        this.unixTimex++;
    }

}