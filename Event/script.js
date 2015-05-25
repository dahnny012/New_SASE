moment().format();
var EventList = React.createClass({
    getInitialState: function() {
        return {
            events:[""]
        };
    },

    componentDidMount: function() {
        $.get(this.props.source,{msg:"query"},function(data){
            data = JSON.parse(data);
            this.setState({
                events:data
            });
        }.bind(this));
    },

    render: function() {
        var nodes =  this.state.events.map(function(e){
            console.log(e.Description);
            return (<div className="events" key={e.EID}>
             <div className="event card blue darken-4">
                <div className="card-content white-text">
                   <span className="card-title">{e.Name}</span>
                   <p>
                      <span className="eventLogistics">{e.Date} {e.Time} {e.Location}</span>
                      <br>
                      {e.Description}
                      <br/>
                      <a className="btn-floating" href={e.FB}>FB</a>
                      </br>
                   </p>
                </div>
                <div className="card-action">
                   <a href="">Edit</a>
                   <a href="">Delete</a>
                </div>
             </div>
             </div>);
        });
        return (<div>
        {nodes}
        </div>)
        
    }
});

var Modal = React.createClass({
    getInitialState:function(){
        return {
            show:false
        }
    },
    onClick:function(){
        if(this.state.show){
            this.setState({
                show:false
            });
        }else{
            this.setState({
                show:true
            })
        }
        },
    render:function(){
        return (  <div id="eventForm" className="">
    <button onClick={this.onClick} className="btn"> {this.state.show ? "Cancel" : "Add a Event"} </button>
    {this.state.show ? <EventForm/> : null}
    </div>)
    }
});

var EventForm = React.createClass({
    render:function(){
        return (
    <div className="formWrapper">
        <div className="row">
          <div className="col s6 offset-s2">
                  <h2 className="header">Add a Event</h2>
          </div>
        </div>
        <div className="row">
      <div className="col s4 offset-s2">
        <label>Name</label>
        <input type="text"/>
      </div>
      <div className="col s4">
        <label> Date</label>
        <input type="text"/>
      </div>
    </div>

    <div className="row">
      <div className="col s4 offset-s2">
        <label>Location</label>
        <input type="text"/>
      </div>
      <div className="col s4">
        <label>Time</label>
        <input type="text"/>
      </div>
    </div>

    <div className="row">
      <div className="col s4 offset-s2">
        <label>Facebook Link</label>
        <input type="text"/>
      </div>
      <div className="col s4">
        <label>Description</label>
        <textarea name="address" className="materialize-textarea"></textarea>
      </div>
    </div>
        <div className="row">
        <div className="col s4 offset-s2">
      <button className="btn">Submit</button>
      </div>
    </div>
    </div>);
    },
}); 


React.render( <EventList source = "https://new-sase-dahnny012.c9.io/API/event.php?msg=query"/> 
, document.getElementById("events"));


React.render(<Modal/>,document.getElementById("Modal"));