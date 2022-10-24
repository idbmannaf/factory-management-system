export default (value)=>{
    const date = new Date(value)
    var month = [
        "Jan",
        "Feb",
        "Mar",
        "Apr",
        "May",
        "Jun",
        "Jul",
        "Aug",
        "Sep",
        "Oct",
        "Nov",
        "Dec",
    ][date.getMonth()];
    return date.getDate() + " " + month +  ", " + date.getFullYear();
}