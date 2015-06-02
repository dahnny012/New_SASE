moment().format();
var query = "https://new-sase-dahnny012.c9.io/API/event.php?msg=query";
var post = "https://new-sase-dahnny012.c9.io/API/event.php";
var fields = ["Name","Date","Location","Time","Description","FB"];


var Event = React.createClass({
    getInitialState: function() {
        return {
            event:"",
            editMode:false,
            delete:false,
            changeQueue:{}
        };
    },
    componentDidMount:function(){
        this.setState({
            event:this.props.event
        });
    },
    queueChange:function(e){
        var temp = this.state.changeQueue;
        temp[e.target.name] = e.target.value;
        this.setState({
            changeQueue:temp
        });
    },
    render:function(){
        var re = this;
        if(this.state.delete)
            return null;
        if(this.state.editMode){
            return (<div className="event card blue darken-4">
            <div className="card-content white-text">
               <input type="text" name="Name" className="card-title" defaultValue={this.state.event.Name} onChange={this.queueChange}/>
               <p>
                  <input type="text" className="card-title" defaultValue={this.state.event.Date} onChange={this.queueChange}/>
                  <input type="text" className="card-title" defaultValue={this.state.event.Time} onChange={this.queueChange}/>
                  <input type="text" className="card-title" defaultValue={this.state.event.Location} onChange={this.queueChange}/>
                  <p>
                  <textarea name="" className="materialize-textarea" defaultValue={this.state.event.Description} onChange={this.queueChange}></textarea>
                  </p>
                  <input type="text" className="card-title" defaultValue={this.state.event.FB} onChange={this.queueChange}/>
               </p>
            </div>
            <div className="card-action">
            
               <button onClick={function(){
                   // Copy Over All Non Changed Data
                   var temp = re.state.changeQueue;
                  fields.forEach(function(field){
                      if(temp[field] === undefined){
                          temp[field] = re.state.event[field]
                      }
                  });
                  
                  // Grab the ID
                  temp.EID = re.state.event.EID;
                  
                  // Send the blob of info
                  $.post(post, {
                      msg: "edit",
                      EID: temp.EID,
                      Name:temp.Name,
                      Location:temp.Location,
                      Time:temp.Time,
                      Date:temp.Date,
                      Description:temp.Description,
                      FB:temp.FB
                      
                  }, function(data) {
                      data = JSON.parse(data);
                      if(data.status !== "success"){
                          alert("Edit was not successful");
                          return;
                      }
                      var newEvent = {};
                      // If successful edit, reflect changes in UI
                      for(var field in temp){
                         newEvent[field] = temp[field];
                      }
                      newEvent.EID = re.state.event.EID;
                      re.setState({
                          editMode:false,
                          event:newEvent,
                          changeQueue:{},
                      });
                      
                  }.bind(re));
               }}>Add</button>
               
               <button onClick={function(){
                   re.setState({
                       editMode:false,
                       changeQueue:{}
                   });
               }}>Cancel</button>
            </div>
         </div>)
        }
        return (<div className="events" key={this.state.event.EID}>
             <div className="event card blue darken-4">
                <div className="card-content white-text">
                   <span className="card-title">{this.state.event.Name}</span>
                   <p>
                      <span className="eventLogistics">{this.state.event.Date} {this.state.event.Time} {this.state.event.Location}</span>
                      <br>
                      {this.state.event.Description}
                      <br/>
                      <a className="btn-floating" href={this.state.event.FB}>FB</a>
                      </br>
                   </p>
                </div>
                <div className="card-action">
                   <button onClick={function(){
                       re.setState({
                           editMode:true
                       });
                   }}>Edit</button>
                   <button onClick={function(){
                       $.post(post,{msg:"delete",EID:re.state.event.EID},function(data){
                           data =  JSON.parse(data);
                           if(data.status !== "success"){
                               alert("Delete was not successful");
                               return;
                           }
                            re.setState({
                                delete:true
                            });

                        }.bind(re));
                   }}>Delete</button>
                </div>
             </div>
             </div>);
    }
})

var EventList = React.createClass({
    getInitialState: function() {
        return {
            events:[]
        };
    },

    componentDidMount: function() {
        $.get(this.props.source,{msg:"query"},function(data){
            data = JSON.parse(data);
            /*
            for(var i=3; i<100; i++){
                var gg = $.extend(true, {}, data[0]);
                gg.EID = i;
                gg.Name = i;
                data.push(gg);
            }
            */
            this.setState({
                events:data
            });
        }.bind(this));
    },

    render: function() {
        var re = this;
        if(this.state.events.length <= 0 ){
            return null;
        }
        var nodes =  this.state.events.map(function(e){
            return (<Event
            event = {e}
            key={e.EID}
            />)
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
    getInitialState: function() {
      return {userInput: ''};
    },
    handleSubmit:function(){
        var re = this;
        var data = {
            Name:React.findDOMNode(this.refs.Name).value,
            Date:React.findDOMNode(re.refs.Date).value,
            Location:React.findDOMNode(re.refs.Location).value,
            Time:React.findDOMNode(re.refs.Time).value,
            Description:React.findDOMNode(re.refs.Description).value,
            FB:React.findDOMNode(re.refs.FB).value,
            msg:"insert"
        };
        $.post(post,data,function(data){
            data = JSON.parse(data);
            if(data.status !== "success"){
                alert("Something wrong with Input");
                return;
            }
            window.location.reload();
        });
    },
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
        <input type="text" ref="Name"/>
      </div>
      <div className="col s4">
        <label> Date</label>
        <input type="date" ref="Date"/>
      </div>
    </div>

    <div className="row">
      <div className="col s4 offset-s2">
        <label>Location</label>
        <input type="text" ref="Location"/>
      </div>
      <div className="col s4">
        <label>Time</label>
        <input type="time" ref="Time"/>
      </div>
    </div>

    <div className="row">
      <div className="col s4 offset-s2">
        <label>Facebook Link</label>
        <input type="text" ref="FB"/>
      </div>
      <div className="col s4">
        <label>Description</label>
        <textarea className="materialize-textarea" ref="Description"></textarea>
      </div>
    </div>
        <div className="row">
        <div className="col s4 offset-s2">
      <button className="btn" onClick={this.handleSubmit}>Submit</button>
      </div>
    </div>
    </div>);
    },
}); 


React.render( <EventList source = "https://new-sase-dahnny012.c9.io/API/event.php"/> 
, document.getElementById("events"));


React.render(<Modal/>,document.getElementById("Modal"));