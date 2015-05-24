moment().format();
Event = React.createClass({
    getInitialState: function() {
        return {
            name: "",
            date: "",
            location: "",
            time: "",
            description: "",
            fb: "",
        };
    },

    componentDidMount: function() {
        $.get(this.props.source, function(result) {
            var result = JSON.parse(result).events[0];
            if (this.isMounted()) {
                this.setState({
                    name: result.name,
                    date: result.data,
                    location: result.location,
                    time: result.time,
                    description: result.description,
                    fb: result.fb
                });
            }
        }.bind(this));
    },

    render: function() {
        return (<div className="events">
         <div className="event card blue darken-4">
            <div className="card-content white-text">
               <span className="card-title">Event name</span>
               <p>
                  <span className="eventLogistics">Time - Date - Location</span>
                  <br>
                  Lorem ipsum dolor sit amet, consectetur adipiscing elit. 
                  Pellentesque quis justo vel arcu fermentum sollicitudin. 
                  Nulla vitae nunc sollicitudin, efficitur justo vel, bibendum odio. 
                  Sed venenatis sapien vitae finibus congue. Morbi lacinia sapien massa, 
                  eu ornare nisl congue ac. Nam nec malesuada ipsum, sed accumsan justo. 
                  Aliquam at aliquam diam.
                  <br/>
                  <button className="btn-floating">FB</button>
                  </br>
               </p>
            </div>
            <div className="card-action">
               <a href="">Edit</a>
               <a href="">Delete</a>
            </div>
         </div>
         </div>);
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
    <button onClick={this.onClick} className="btn">Add a Event</button>
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
      <button className="btn modal-close">Cancel</button>
      <button className="btn">Submit</button>
      </div>
    </div>
    </div>);
    },
}); 


React.render( <Event source = "https://new-sase-dahnny012.c9.io/API/event.php"/> 
, document.getElementById("events"));


React.render(<Modal/>,document.getElementById("Modal"));